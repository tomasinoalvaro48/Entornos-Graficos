<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifica tu correo</title>
</head>

<body style="background-color:#eef1f7;">
  <table width="100%" style="background-color:#eef1f7;">
    <tr>
      <td>
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:600px; background-color:#ffffff; border:1px solid #d9deea; border-radius:10px; overflow:hidden;">
          <tr>
            <td style="background-color:#1f4d8b; color:#ffffff;">
              <h1 style="font-size:32px; font-weight:700;">Hola <?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></h1>
              <p style="font-size:18px; line-height:1.4; font-weight:600;">Verifica tu direccion de e-mail</p>
            </td>
          </tr>
          <tr>
            <td style="padding:12px 24px 8px; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
              <img src="cid:verify_mail_cid" alt="Computadora con contraseña" style="width:100%; max-width:560px; height:auto; border-radius:6px; margin-bottom:20px;">
              <p style="margin:0 0 12px; font-size:16px; line-height:1.6;">Para activar tu cuenta, hace click en el siguiente boton:</p>
              <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td style="background-color:#0d8aa8; border-radius:6px;">
                    <a href="<?php echo htmlspecialchars($verifyUrl, ENT_QUOTES, 'UTF-8'); ?>" style="display:inline-block; padding:12px 18px; font-size:16px; font-weight:700; color:#ffffff; text-decoration:none; font-family:Arial, Helvetica, sans-serif;">Verificar cuenta</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:20px 24px 28px; font-family:Arial, Helvetica, sans-serif; color:#6b7280;">
              <p style="margin:0; font-size:13px; line-height:1.6;">Si vos no creaste esta cuenta, podes ignorar este correo.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>