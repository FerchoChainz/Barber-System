<?php 
namespace Controllers;

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

        $router->render('auth/create-account',[]);
    }
}
