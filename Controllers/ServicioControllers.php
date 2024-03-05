<?php

namespace Controllers;

use Models\Servicio;
use Models\Usuario;
use MVC\Router;

class ServicioControllers{
    public static function index(Router $router){

        session_start();

        isAdmin();

        $servicios = Servicio::all();
        $alertas = [];

        $router->render('/servicios/index',[
            'nombre'=>$_SESSION['nombre'],
            'servicios'=>$servicios, 
            'alertas'=>$alertas
        ]);


    }
    public static function crear(Router $router){

        session_start();

        isAdmin();

        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('location: /admin');
            }
        }


        
        $router->render('/servicios/crear',[
            'nombre'=>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }
    public static function actualizar(Router $router){

        session_start();
        isAdmin();

        $alertas = [];

        $id = $_GET['id'] ?? '';
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('location: /admin');
            exit;
        }
        $servicio = Servicio::find($id);

        if(is_null($servicio)){
            header('location: /admin');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){

                $servicio->guardar();
                
                header('location: /servicios');

            }
        }

        $router->render('/servicios/actualizar',[
            'nombre'=>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }

    public static function eliminar(Router $router){

        session_start();

        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio = Servicio::find($_POST['id']);

            $servicio->eliminar();

            header('location: /servicios');
        }
    }
}