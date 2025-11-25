<?php

namespace Controllers;

use Model\Service;

class APIController{

    public static function index(){
        $servicios = Service::all();

        echo json_encode($servicios);
    }
}