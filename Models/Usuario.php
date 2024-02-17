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

    public function validarLogin(){

        self::$alertas = [];

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        $valido = preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $this->email);
        
        if($valido == 0){
            self::$alertas['error'][]='El email es invalido';
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

    public function verificarUsuario(){

        $auth = self::where('email', $this->email);
        
        if($auth){

            $resultado = password_verify($this->password , $auth->password);

            if($resultado){

                return $auth;

            }else{
                self::$alertas['error'][]= 'El usuario o contraseña son incorrectos';

                return $resultado;
            }
        }else{

            self::$alertas['error'][] = 'El usuario o contraseña son incorrectos';

            return false;
        }

    }


    public function hashPass(){

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

    }

    public function generarToken(){
        $this->token = uniqid();
    }

    public function verificarConfirmado(){

        if($this->confirmado == 0){
            header('location: /mensaje');

            exit;
        }

    }

    public function iniciarSesion(){

        session_start();

        $_SESSION['id'] = $this->id;
        $_SESSION['nombre'] = $this->nombre . " " .$this->apellido;
        $_SESSION['email'] = $this->email;
        $_SESSION['confirmado'] = $this->confirmado;
        $_SESSION['login'] = true;
        $_SESSION['telefono'] = $this->telefono;

        if($this->admin === '1'){
            $_SESSION['admin'] = $this->admin ?? null;
            header('location: /admin');
        }else{
            header('location: /cita');
        }
    }

}