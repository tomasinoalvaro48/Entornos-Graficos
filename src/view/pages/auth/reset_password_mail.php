<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar contraseña</title>
</head>

<body style="background-color:#eef1f7;">
  <table width="100%" style="background-color:#eef1f7;">
    <tr>
      <td>
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:600px; background-color:#ffffff; border:1px solid #d9deea; border-radius:10px; overflow:hidden;">
          
          <tr>
            <td style="background-color:#1f4d8b; color:#ffffff; padding:20px;">
              <h1 style="font-size:28px; font-weight:700;">
                Hola <?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?>
              </h1>
              <p style="font-size:18px;">Recuperá tu contraseña</p>
            </td>
          </tr>

          <tr>
            <td style="padding:20px; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
              <p style="font-size:16px;">
                Hacé click en el siguiente botón para cambiar tu contraseña:
              </p>

              <table role="presentation">
                <tr>
                  <td style="background-color:#0d8aa8; border-radius:6px;">
                    <a href="<?php echo htmlspecialchars($resetUrl, ENT_QUOTES, 'UTF-8'); ?>"
                      style="display:inline-block; padding:12px 18px; font-size:16px; font-weight:700; color:#ffffff; text-decoration:none;">
                      Cambiar contraseña
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding:20px; font-size:13px; color:#6b7280;">
              <p>
                Si no solicitaste este cambio, podes ignorar este correo.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>

</html>