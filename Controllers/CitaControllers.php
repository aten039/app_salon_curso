<?php 

namespace Controllers;

use Clases\Email;
use MVC\Router;
use Models\Servicio;
use Models\Usuario;

class CitaControllers{


    public static function index(Router $router){

        session_start();


        $router->render('/citas/index', [
            'nombre'=> $_SESSION['nombre']
        ]);

    }

}