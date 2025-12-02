<?php 
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController {

    public static function login(Router $router){
        $errors = [];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $errors = $auth->validateLogin();
            
            if(empty($errors)){
                $user = User::where('email', $auth->email);;
                // check password
                if($user){
                    if( $user->checkPasswordAndVerify($auth->password)){
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['nombre'] = $user->nombre . ' ' . $user->apellido;;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        // Redirecting
                        if($user->admin === '1'){
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        } else{
                            header('Location: /cita');
                        }


                    }

                } else{
                    // user not finded 
                    User::setErrors('error', 'Usuario no encontrado');
                }
            } 
        }

        $errors = User::getErrors();  

        $router->render('auth/login',[
            'errors' => $errors,
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];

        header('Location: /');
    }

    public static function forgetPassword(Router $router){
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);

            $errors = $auth->validateEmail();

            if(empty($errors)){
                // search by col email
                $user = User::where('email', $auth->email);

                if($user && $user->confirmado === '1'){
                    // generate new token
                    $user->createToken();
                    $user->saveUpdate();

                    // debbuger($user);

                    //send email
                    $email = new Email($user->email, $user->nombre, $user->token);
                    $email->sendInstructions();

                    // Alert succes
                    User::setErrors('succes', 'Las instrucciones han sido enviadas a su correo');
                } else {
                    User::setErrors('error', 'El nombre de usuario no existe o no esta confirmado');
                }
                // debbuger($user);
            }
        }
        
        $errors = User::getErrors();

        $router->render('auth/forget-psswd',[
            'errors' => $errors
        ]);
    }

    public static function recoverPassword(Router $router){
        $errors = [];
        $error = false;

        $token = s($_GET['token']);

        // search user by token 
        $user = User::where('token', $token);
        
        if(empty($user)){
            User::setErrors('error', 'Token no valido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // save new password
            $password = new User($_POST);
            $errors = $password->validateNewPassword();
            
            if(empty($errors)){
                $user->password = null;
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = null;

                $result = $user->saveUpdate();

                if($result){
                    header('Location: /');
                }
            }

        }


        $errors = User::getErrors();
        // debbuger($user);
        $router->render('auth/recover-psswd',[
            'errors' => $errors,
            'error' => $error
        ]);
    }

    public static function createAccount(Router $router){
        $user = new User();

        // errors
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user->sync($_POST);
            $errors = $user->validateNewAccount();

            // check if errors is empty
            if(empty($errors)){
                // check if user is not registered 
                $resultado = $user->userExist();

                if($resultado->num_rows){
                    $errors = User::getErrors();
                } else {
                    // hash password
                    $user->hashPassword();

                    // generate unique token
                    $user->createToken();

                    // send email
                    $email = new Email(
                        $user->nombre, $user->email,$user->token
                    );

                    $email->sendConfirmation();


                    // create user
                    $resultado = $user->saveData();
                    if($resultado){
                        header('Location: /message');
                    }
                }

            }
        }

        $router->render('auth/create-account',[
            'user' => $user,
            'errors' =>$errors
        ]);
    }

    public static function message(Router $router){
        $router->render('auth/message'); 
    }

    public static function confirmAccount(Router $router){
        $errors = [];

        $token = s($_GET['token']);

        $user = User::where('token', $token);

        if(empty($user)){
            // show error message
            User::setErrors('error', 'Invalid Token');
        } else {
            // show succes message
            $user->confirmado = '1';
            $user->token = null;
            $user->saveUpdate();


            User::setErrors('succes', 'Tu cuenta ha sido confirmada. Gracias');
        }

        $errors = User::getErrors();
        $router->render('auth/confirm-account',[
            'errors' => $errors
        ]);

    }
}
