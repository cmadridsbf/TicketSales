<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

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

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('info@ticketsales.store');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>
            <head>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                }
                .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .header {
                background-color: #3498db;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                border-radius: 5px 5px 0 0;
                }
                .content {
                padding: 20px;
                }
                .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                }
            </style>
            </head>
            <body>
            <div class="container">
                <div class="header">
                <h1>¡Bienvenido a TicketSale!</h1>
                </div>
                <div class="content">
                <p><strong>Hola ' . $this->nombre .  '</strong>,</p>
                <p>Has registrado correctamente tu cuenta en TicketSale, pero es necesario confirmarla.</p>
                <p>Por favor, presiona el botón de abajo para confirmar tu cuenta:</p>
                <a class="button" href="' . $_ENV['HOST'] . '/confirmar-cuenta?token=' . $this->token . '">Confirmar Cuenta</a>
                <p>Si no creaste esta cuenta, puedes ignorar este mensaje.</p>
                </div>
            </div>
            </body>
            </html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('info@ticketsales.store');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>
            <head>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                }
                .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .header {
                background-color: #3498db;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                border-radius: 5px 5px 0 0;
                }
                .content {
                padding: 20px;
                }
                .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                }
            </style>
            </head>
            <body>
            <div class="container">
                <div class="header">
                <h1>Reestablecer Contraseña</h1>
                </div>
                <div class="content">
                <p><strong>Hola ' . $this->nombre . '</strong>,</p>
                <p>Has solicitado restablecer tu contraseña en TicketSale. Sigue el enlace de abajo para hacerlo:</p>
                <p><a class="button" href="' . $_ENV['HOST'] . '/reestablecer?token=' . $this->token . '">Reestablecer Contraseña</a></p>
                <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                </div>
            </div>
            </body>
            </html>';

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }


    public function enviarConfirmacionBoleto() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('info@ticketsales.store');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Boleto Adquirido';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>
            <head>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                }
                .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .header {
                background-color: #3498db;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                border-radius: 5px 5px 0 0;
                }
                .content {
                padding: 20px;
                }
                .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                }
            </style>
            </head>
            <body>
            <div class="container">
                <div class="header">
                <h1>Boleto Adquirido</h1>
                </div>
                <div class="content">
                <p><strong>Hola ' . $this->nombre . '</strong>,</p>
                <p>Has adquirido tu boleto para TicketSales</p>
                <p><a class="button" href="' . $_ENV['HOST'] . '/boleto?id=' . $this->token . '">Ver Boleto</a></p>
                <p>Estamos encantados de tenerte con nosotros.</p>
                </div>
            </div>
            </body>
            </html>';

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}