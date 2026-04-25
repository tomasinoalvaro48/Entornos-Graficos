<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/env.php';

function sendResetPasswordEmail($mailUsuario, $token, $nombreUsuario)
{
  $appUrl = rtrim($_ENV['APP_URL'], '/');
  $basePath = rtrim($_ENV['APP_BASE_PATH'] ?? '', '/');

  $resetUrl = $appUrl . $basePath . '/src/controller/reset_password.php?mail=' . urlencode($mailUsuario) . '&token=' . urlencode($token);

  ob_start();
  include __DIR__ . "/../view/pages/auth/reset_password_mail.php";
  $mailContent = ob_get_clean();

  $mail = new PHPMailer(true);

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
  $mail->Subject = 'Recuperar contraseña';
  $mail->Body = $mailContent;
  $mail->AltBody = 'Recuperar contraseña: ' . $resetUrl;

  return $mail->send();
}