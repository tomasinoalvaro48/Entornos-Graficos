<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/env.php';

function sendContactEmail($nombreUsuario, $emailUsuario, $mensaje)
{
  $email = new PHPMailer(true);

  //Server settings
  $email->SMTPDebug = SMTP::DEBUG_OFF; //Disable debug output
  $email->isSMTP(); //Send using SMTP
  $email->Host = $_ENV['SMTP_HOST']; //Set the SMTP server to send through
  $email->SMTPAuth = true; //Enable SMTP authentication
  $email->Username = $_ENV['SMTP_USERNAME']; //SMTP username
  $email->Password = $_ENV['SMTP_PASSWORD']; //SMTP password
  $email->SMTPSecure = $_ENV['SMTP_ENCRYPTION']; //Enable implicit TLS encryption
  $email->Port = (int) $_ENV['SMTP_PORT'];

  //Recipients
  $email->setFrom($emailUsuario, $nombreUsuario);
  $email->addAddress($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']); //Add a recipient

  //Content
  $email->isHTML(false);
  $email->CharSet = 'UTF-8';
  $email->Encoding = 'base64';
  $email->Subject = 'Rivendell Plaza - Contacto desde el Formulario';
  $email->Body = $nombreUsuario . " - Email: " . $emailUsuario . ", ha enviado este mensaje: " . $mensaje;
  $email->AltBody = $nombreUsuario . " - Email: " . $emailUsuario . ", ha enviado este mensaje: " . $mensaje;

  try {
    return $email->send();
  } catch (Exception $exception) {
    return false;
  }
}
