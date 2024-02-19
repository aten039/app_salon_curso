<?php 

namespace Controllers;

use Clases\Email;
use MVC\Router;
use Models\Servicio;
use Models\Usuario;

class LoginControllers{

    public static function crear_cuenta(Router $router){

        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD']  === 'POST'){

            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar();
            
            if(empty($alertas)){

                $resultado = $usuario->verificarExistencia();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{

                    $usuario->hashPass();

                    //generar token
                    $usuario->generarToken();

                    //enviar email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();


                    $resultado = $usuario->guardar();

                    if($resultado['resultado']){
                        header('location: /mensaje');
                    }

                }
            }
        }

        $router->render('/auth/registrar', [
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('/auth/mensaje');

    }
    
    public static function confirmar(Router $router){

        $alertas=[];

        if(!$_GET['token']){
            header('location: /');
        }
        
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Su token no es valido');
        }else{
            
            Usuario::setAlerta('exito', 'Su cuenta ha sido confirmada');
            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();
        }
        
        $alertas = Usuario::getAlertas();

        $router->render('/auth/confirmar', [
            'alertas'=>$alertas
        ]);

    }


    public static function login(Router $router){

        $usuario = new Usuario();
        $alertas=[];

        if($_SERVER['REQUEST_METHOD']==='POST'){

            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if(empty($alertas)){

                $auth = $usuario->VerificarUsuario();

                if($auth){

                    $auth->verificarConfirmado();
                    $auth->iniciarSesion();


                }else{
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $router->render('/auth/login', [
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);

    }

    public static function logout(){
        echo 'desde el logout';
    }

    public static function recuperarPass(Router $router){

        $alertas = [];
        $usuario = new Usuario();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarEmail();
            
            if(empty($alertas)){
                $auth = Usuario::where('email', $usuario->email);
                
                if($auth && $auth->confirmado == '1'){
                    $auth->generarToken();
                    $auth->guardar();

                    $email = new Email($auth->email, $auth->nombre, $auth->token);
                    $email->enviarToken();

                    Usuario::setAlerta('exito', 'Verifica tu email');
                    
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    
                    
                }
            }
        }
        $alertas= Usuario::getAlertas();

        $router->render('/auth/recover_pass', [
            'alertas'=>$alertas,
            'usuario'=>$usuario
        ]);
    }
    
    public static function recuperar(Router $router){

        if(!$_GET['token']){
            header('location: /');
        }

        $alertas = [];
        $token = s($_GET['token']);
        
        // buscar usuario por su token
        $usuario = Usuario::where('token' , $token);

        if(empty($usuario)){
            header('location: /');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPassword();
            
            if(empty($alertas)){
                $usuario->hashPass();
                $usuario->token = '';
                $usuario->guardar();

                header('location: /');
            }

        }

        $router->render('/auth/recover', [
            'alertas'=>$alertas,
            
        ]);
    }
    
}