<?php 

namespace Controllers;

use MVC\Router;

class LoginControllers{

    public static function crear_cuenta(Router $router){
        
        $router->render('/auth/registrar', []);
    }

    public static function login(Router $router){

        if($_SERVER['REQUEST_METHOD']==='POST'){
            formatearDatos($_POST);
        }

        $router->render('/auth/login', []);

    }

    public static function logout(){
        echo 'desde el logout';
    }

    public static function recuperarPass(Router $router){
        $router->render('/auth/recover_pass', []);
    }
    
    public static function recuperar(){
        echo 'Recuperar Pass nueva contrase;a';
    }
    
}