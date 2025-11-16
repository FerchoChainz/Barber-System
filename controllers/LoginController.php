<?php 
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController {

    public static function login(Router $router){
        $router->render('auth/login',[]);
    }

    public static function logout(){
        echo 'desde logout';
    }

    public static function forgetPassword(Router $router){
        $router->render('auth/forget-psswd',[]);
    }

    public static function recoverPassword(){
        echo 'desde recuperar';
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
