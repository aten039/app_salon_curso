<?php

namespace Controllers;

use Models\Servicio;
use Models\Cita;
use Models\CitaServicio;

class ApiControllers{

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);

    }

    public static function guardar(){
        //almacena la cita y devuelve el resultado y el id
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();

        

        //almacena la cita con los servicios

        $idServicios = explode(',', $_POST['servicios']);

        foreach($idServicios as $idServicio){

            $arg = ['citaId'=>$resultado['id'], 'servicioId'=>$idServicio];

            $citaServicio = new CitaServicio($arg);
            $citaServicio->guardar();

        }
      
    echo json_encode($resultado);


    }
}