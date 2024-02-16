<?php

namespace Models;

class Usuario extends ActiveRecord{
    
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public $passwordVerify;


    public function __construct($arg=[])
    {
        $this->id=$arg['id'] ?? null;
        $this->nombre=$arg['nombre'] ?? '';
        $this->apellido=$arg['apellido'] ?? '';
        $this->email=$arg['email'] ?? '';
        $this->password=$arg['password'] ?? '';
        $this->telefono=$arg['telefono'] ?? '';
        $this->admin=$arg['admin'] ?? 0;
        $this->confirmado=$arg['confirmado'] ?? 0;
        $this->token=$arg['token'] ?? '';

        $this->passwordVerify=$arg['passwordVerify'] ?? '';
    }

    public function validar() {
        static::$alertas = [];

        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido es obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][]='El telefono es obligatorio';
        }
        if(strlen($this->telefono) != 10){
            self::$alertas['error'][]='El telefono debe tener 10 caracteres';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        $valido = preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $this->email);
        
        if($valido == 0){
            self::$alertas['error'][]='El email es invalido';
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        if(strlen($this->password) < 8){
            self::$alertas['error'][]='El password debe tener minimo 8 caracteres';
        }
        if($this->password != $this->passwordVerify){
            self::$alertas['error'][]='El password no coincide';
        }

        return self::$alertas;
    }

    public function verificarExistencia(){

        $email = ActiveRecord::$db->escape_string($this->email);

        $query = "SELECT * FROM usuarios WHERE email ='" . $email . "' LIMIT 1";
        
        $resultado = ActiveRecord::$db->query($query);

        if($resultado->num_rows){

            self::$alertas['error'][] = 'el usuario ya existe';

        }

        return $resultado;
    }

    public function hashPass(){

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

    }

    public function generarToken(){
        $this->token = uniqid();
    }

}