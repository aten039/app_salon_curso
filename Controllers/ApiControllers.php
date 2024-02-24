<?php

namespace Controllers;

use Models\Servicio;


class ApiControllers{

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);

    }
}