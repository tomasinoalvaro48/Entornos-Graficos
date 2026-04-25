<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estado de promoción</title>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7;">
  <table width="100%" style="padding:24px;">
    <tr>
      <td align="center">
        <table style="max-width:620px; background:#fff; border-radius:12px; border:1px solid #ddd;">
          <tr>
            <td style="padding:24px; background:#0f4c81; color:white;">
              <h2>Estado de tu promoción</h2>
              <p>Hola <?php echo htmlspecialchars($nombreUsuario); ?>,</p>
            </td>
          </tr>

          <tr>
            <td style="padding:24px; font-family:Arial;">
              <p>Tu promoción fue <strong><?php echo strtoupper($estado); ?></strong>.</p>

              <p><strong>Promoción:</strong></p>
              <p><?php echo htmlspecialchars($textoPromo); ?></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>