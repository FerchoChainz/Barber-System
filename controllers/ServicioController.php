<?php  

namespace Controllers;

use Error;
use Model\Service;
use MVC\Router;

class ServicioController {

    public static function index(Router $router){

        session_start();

        $router->render('services/index', [
            'nombre' => $_SESSION['nombre']
        ]);
    }
    public static function create(Router $router){

        session_start();

        $servicio = new Service();
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sync data of method POST
            $servicio->sync($_POST);

            // validate
        }


        $router->render('services/create', [
            'nombre' => $_SESSION['nombre'],
            'servicio' =>$servicio,
            'errors'=>$errors
        ]);

    }
    public static function update(Router $router){

        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){}

        $router->render('services/update', [
            'nombre' => $_SESSION['nombre']
        ]);
    }
    public static function delete(Router $router){

        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){}
    }
}