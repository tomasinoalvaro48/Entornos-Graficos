<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/env.php';

function sendNotiPromocionEmail($mailUsuario, $nombreUsuario, $textoPromo, $estado)
{
  $appUrl = rtrim($_ENV['APP_URL'], '/');
  $basePath = rtrim($_ENV['APP_BASE_PATH'] ?? '', '/');

  ob_start();
  include __DIR__ . "/../../view/pages/promocion/noti_promocion_email.php";
  $mailContent = ob_get_clean();

  $mail = new PHPMailer(true);

  $mail->SMTPDebug = SMTP::DEBUG_OFF;
  $mail->isSMTP();
  $mail->Host = $_ENV['SMTP_HOST'];
  $mail->SMTPAuth = true;
  $mail->Username = $_ENV['SMTP_USERNAME'];
  $mail->Password = $_ENV['SMTP_PASSWORD'];
  $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];
  $mail->Port = (int) $_ENV['SMTP_PORT'];

  $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
  $mail->addAddress($mailUsuario, $nombreUsuario);

  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';

  $mail->Subject = 'SITIO - Estado de su promoción actualizado';
  $mail->Body = $mailContent;
  $mail->AltBody = "Hola $nombreUsuario. Su promoción fue $estado.";

  return $mail->send();
}