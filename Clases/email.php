<?php 

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    



class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //crear objeto mailer
        $phpmailer = new PHPMailer();

        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '13ef5fa69f80fd';
        $phpmailer->Password = '8380eb40115157';

        //quien lo envia
        $phpmailer->setFrom('cuentas@appsalon.com');
        //quien recibe
        $phpmailer->addAddress('l.elvis039@gmail.com', 'Elvis');
        //asunto del correo
        $phpmailer->Subject = 'Confirma tu cuenta';
        //habilitar el html y el charset
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet =  'UTF-8';
        //contenido html del mensaje
        $contenido='<html>';
        $contenido.='<p><strong> Hola ' . $this->nombre . '</strong> Has creado tu cuenta en app salon, solo debes confirmarla presionando el siguiente enlace</p>';
        $contenido.='<p> Presione aqui: <a style="padding: 15px; background-color: azul; border = 2px solid azul" href="http://localhost/confirmar-cuenta?token=' . $this->token  .'">Confirmar</a> ';
        $contenido.='<p>Si tu no solicitaste el cambio, resstablece el password para mayor seguridad</p>';
        $contenido.='</html>';

        $phpmailer->Body = $contenido;

        //enviar email

        $phpmailer->send();

    }
       
}