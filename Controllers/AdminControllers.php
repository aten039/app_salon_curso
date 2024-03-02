<?php

namespace Controllers;

use Models\AdminCita;
use MVC\Router;

class AdminControllers{


    public static function admin(Router $router) {

        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('location: /404');
        }

        $consulta =" SELECT citas.id, citas.hora, CONCAT (usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta.= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio ";
        $consulta.= " FROM citas ";
        $consulta.= " LEFT OUTER JOIN usuarios "; 
        $consulta.= " ON citas.usuarioId=usuarios.id ";
        $consulta.= " LEFT OUTER JOIN citasservicios ";
        $consulta.= " ON citasservicios.citaId=citas.id ";
        $consulta.= " LEFT OUTER JOIN servicios ";
        $consulta.= " ON citasservicios.servicioId=servicios.id ";
        $consulta.= " WHERE fecha = '{$fecha}' ";

       
        $citas = AdminCita::SQL($consulta);
       

        $router->render('/admin/index', [
            'nombre'=>$_SESSION['nombre'],
            'citas'=>$citas,
            'fecha'=>$fecha
        ]);
    } 
}