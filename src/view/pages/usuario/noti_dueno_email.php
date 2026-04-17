<!doctype html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cuenta aprobada</title>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7;">
	<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#eef2f7; padding:24px 12px;">
		<tr>
			<td align="center">
				<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:620px; background-color:#ffffff; border:1px solid #d9e2ec; border-radius:12px; overflow:hidden;">
					<tr>
						<td style="padding:26px 24px; background:linear-gradient(135deg, #0f4c81 0%, #156ea8 100%); color:#ffffff; font-family:Arial, Helvetica, sans-serif;">
							<h1 style="margin:0; font-size:30px; line-height:1.2;">Tu cuenta fue aprobada</h1>
							<p style="margin:10px 0 0; font-size:17px; line-height:1.5;">Hola <?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?>, un administrador validó tu registro correctamente.</p>
						</td>
					</tr>

					<tr>
						<td style="padding:24px; font-family:Arial, Helvetica, sans-serif; color:#243b53;">
							<p style="margin:0 0 14px; font-size:16px; line-height:1.7;">Ya podés ingresar al sistema y comenzar a gestionar tu cuenta de dueño.</p>

							<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin:12px 0 16px;">
								<tr>
									<td style="background-color:#0f766e; border-radius:8px;">
										<a href="<?php echo htmlspecialchars($loginUrl, ENT_QUOTES, 'UTF-8'); ?>" style="display:inline-block; padding:12px 20px; font-size:16px; font-weight:700; color:#ffffff; text-decoration:none; font-family:Arial, Helvetica, sans-serif;">Iniciar sesion</a>
									</td>
								</tr>
							</table>

							<p style="margin:0; font-size:14px; line-height:1.6; color:#627d98;">Si no solicitaste esta cuenta, contactanos para revisar el caso.</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
