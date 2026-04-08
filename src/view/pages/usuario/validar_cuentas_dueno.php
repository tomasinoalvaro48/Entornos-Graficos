<?php
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();

$duenos = showDuenos();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validar Cuentas de Dueños</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="container">
    <div class="row">
      <div class="col">
        <h1 class="text-center">Cuentas de Dueños</h1>
      </div>
    </div>

    <?php if ($error) { ?>
      <div class="row mb-3">
        <div class="col">
          <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ($success) { ?>
      <div class="row mb-3">
        <div class="col">
          <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="row">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($duenos)) { ?>
                <tr>
                  <td colspan="4" class="text-center">No hay cuentas de Dueños registradas.</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($duenos as $dueno) {
                  if (isset($_GET['estado']) && $dueno->estadoDueno !== $_GET['estado']) {
                    continue; // Saltar este dueño si no coincide con el filtro de estado
                  }
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($dueno->idUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($dueno->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($dueno->emailUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                      <span class="badge text-bg-success">
                        <?php echo strtoupper(htmlspecialchars($dueno->estadoDueno, ENT_QUOTES, 'UTF-8')); ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($dueno->estadoDueno === 'pendiente') { ?>
                        <a href="/src/controller/dueno/handle_validar_cuenta.php?id=<?php echo urlencode($dueno->idUsuario); ?>"
                          class="btn btn-sm btn-primary">
                          Validar Cuenta
                        </a>
                      <?php } else { ?>
                        <div class="text-muted">Ya Validado</div>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col text-center">
        <a href="/" class="btn btn-secondary">Volver al Menú</a>
      </div>
    </div>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>