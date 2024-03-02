<?php

namespace Controllers;

use Models\Servicio;
use Models\Cita;
use Models\CitaServicio;
use Models\Usuario;

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
    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $cita = Cita::find($_POST['id']);

            $cita->eliminar();

            header('location:' . $_SERVER['HTTP_REFERER']);

        }



    }
}

