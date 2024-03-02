<?php

function formatearDatos($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//funcion que revisa si el usuario esta autenticado

function isAuth():void{
    if(!isset($_SESSION['login'])){
        header('location: /');
    }
}

function isAdmin():void{


    if(!isset($_SESSION['login']) || !isset($_SESSION['admin'])){
        header('location: /');
    }


}