<?php

namespace MVC;

class Router{

    public array $rutasGet = [];
    public array $rutasPost = [];


    public function get($url , $fn){
        $this->rutasGet[$url] = $fn;
    }

    public function post($url , $fn){
        $this->rutasPost[$url] = $fn;
    }

    public function comprobarUrl(){
        
        $urlActual = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'] ?? "";
        $method = $_SERVER['REQUEST_METHOD'] ?? '';

        if(str_contains($urlActual, "?")){
            $urlActual = explode( "?", $urlActual );
            $urlActual = $urlActual[0];
        }
        
        if($method === 'GET'){            
            $fn = $this->rutasGet[$urlActual] ?? null;
        }
        if($method === 'POST'){            
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        if($fn){
            $fn = call_user_func( $fn, $this);
            
        }else{
            echo '<h1> ERROR 404</h1>';
            echo '</p>La URL introducida es invalidad, por favor intente nuevamente</p>';
        }

    }
    public function render($view, $datos=[]){
        
        foreach($datos as $key=>$value){
            $$key=$value;
        }

        ob_start();
        include_once __DIR__ . '/Views' . $view . '.php';
        $main = ob_get_clean();

        include_once __DIR__ . '/Views/layout.php';

    }

}