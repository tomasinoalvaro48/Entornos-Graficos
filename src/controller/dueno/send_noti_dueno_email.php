<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/env.php';

function sendNotiDuenoEmail($mailUsuario, $nombreUsuario)
{
  // Capturar el contenido HTML usando output buffering
  ob_start();
  include __DIR__ . "/../../view/pages/usuario/noti_dueno_email.php";
  $mailContent = ob_get_clean();

  $mail = new PHPMailer(true);

  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_OFF; //Disable debug output
  $mail->isSMTP(); //Send using SMTP
  $mail->Host = $_ENV['SMTP_HOST']; //Set the SMTP server to send through
  $mail->SMTPAuth = true; //Enable SMTP authentication
  $mail->Username = $_ENV['SMTP_USERNAME']; //SMTP username
  $mail->Password = $_ENV['SMTP_PASSWORD']; //SMTP password
  $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION']; //Enable implicit TLS encryption
  $mail->Port = (int) $_ENV['SMTP_PORT'];

  //Recipients
  $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
  $mail->addAddress($mailUsuario, $nombreUsuario); //Add a recipient

  //Content
  $mail->isHTML(true); //Set email format to HTML
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';
  $mail->Subject = 'SITIO - cambio de Estado en su Cuenta';
  $mail->Body = $mailContent;
  $mail->AltBody = 'Hola ' . $nombreUsuario . '. Le informamos que su cuenta ha sido aprobada por un administrador. Ya puede iniciar sesión.';

  return $mail->send();
}
