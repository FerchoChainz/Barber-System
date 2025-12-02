<?php

namespace Controllers;

use Model\DateServices;
use Model\Service;
use Model\Date;

class APIController{

    public static function index(){
        $servicios = Service::all();

        echo json_encode($servicios);
    }


    public static function save(){

        // save the date and return the ID
        $cita = new Date($_POST);
        $resultado = $cita->saveUpdate();

        $id = $resultado['id'];

        // debbuger($cita);

        // save the date and the servicess
        // save the services whit the id Date

        // separate the idServices with ',' and turning into array
        $idServicios = explode(',',$_POST['servicios']);

        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new DateServices($args);
            $citaServicio->saveData();
        }
        
        echo json_encode(['resultado' => $resultado]);
    }
}
