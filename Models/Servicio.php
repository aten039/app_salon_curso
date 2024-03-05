<?php

namespace Models;

class Servicio extends ActiveRecord{
    
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;
    


    public function __construct($arg=[])
    {
        $this->id=$arg['id'] ?? null;
        $this->nombre=$arg['nombre'] ?? '';
        $this->precio=$arg['precio'] ?? '';
    }

    public function validar(){

        self::$alertas = [];

        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
        }
        if(!$this->precio){
            self::$alertas['error'][] = 'El precio del servicio es obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio no es valido';
        }

        return self::$alertas;

    }



}