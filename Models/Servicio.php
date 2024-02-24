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

    



}