<?php  

namespace Controllers;

use Error;
use Model\Service;
use MVC\Router;
use Serializable;

class ServicioController {

    public static function index(Router $router){
        session_start();

        isAdmin();

        $servicios = Service::all();

        $router->render('services/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function create(Router $router){

        session_start();
        isAdmin();

        $servicio = new Service();
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sync data of method POST
            $servicio->sync($_POST);

            // validate

            $errors = $servicio->validate();

            if(empty($errors)){
                $servicio->saveUpdate();
                header('Location: /servicios');
            }
        }


        $router->render('services/create', [
            'nombre' => $_SESSION['nombre'],
            'servicio' =>$servicio,
            'errors'=>$errors
        ]);

    }
    public static function update(Router $router){

        session_start();
        isAdmin();

        $servicio = Service::find($_GET['id']);
        $errors = [];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sync($_POST);

            $errors = $servicio->validate();

            if(empty($errors)){
                $servicio->saveUpdate();

                header('Location: /servicios');
            }
        }

        $router->render('services/update', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'errors' => $errors
        ]);
    }
    public static function delete(Router $router){

        session_start();
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            $servicio = Service::find($id);
            $servicio->delete();

            header('Location: /servicios');
        }
    }
}