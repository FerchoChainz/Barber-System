<?php

namespace Controllers;

use Model\Service;
use Model\Date;

class APIController{

    public static function index(){
        $servicios = Service::all();

        echo json_encode($servicios);
    }


    public static function save(){

        $cita = new Date($_POST);

        // debbuger($cita);

        $resultado = $cita->saveUpdate();
        
        echo json_encode($resultado);
    }
}
