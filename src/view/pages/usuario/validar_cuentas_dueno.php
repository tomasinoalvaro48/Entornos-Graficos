<?php
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";

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

    <?php include __DIR__ . '/../../components/alerts.php'; ?>

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
                  <td colspan="5" class="text-center">No hay cuentas de Dueños registradas.</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($duenos as $dueno) {
                  if (isset($_GET['estado']) && $dueno->estadoDueno !== $_GET['estado']) {
                    continue; // Saltar este dueño si no coincide con el filtro de estado
                  }

                  $estadoDueno = strtolower((string)$dueno->estadoDueno);
                  $estadoBadgeClass = 'text-bg-secondary';
                  if ($estadoDueno === 'pendiente') {
                    $estadoBadgeClass = 'text-bg-warning';
                  } else if ($estadoDueno === 'aprobado') {
                    $estadoBadgeClass = 'text-bg-success';
                  } else if ($estadoDueno === 'rechazado') {
                    $estadoBadgeClass = 'text-bg-danger';
                  }

                  $modalId = 'modal-validar-dueno-' . (int)$dueno->idUsuario;
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($dueno->idUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($dueno->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($dueno->emailUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                      <span class="badge <?php echo $estadoBadgeClass; ?>">
                        <?php echo strtoupper(htmlspecialchars($dueno->estadoDueno, ENT_QUOTES, 'UTF-8')); ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($dueno->estadoDueno === 'pendiente') { ?>
                        <button
                          type="button"
                          class="btn btn-sm btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                          Gestionar Cuenta
                        </button>

                        <div class="modal fade" id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Validar cuenta de dueño</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">
                                <p class="mb-3">¿Qué desea hacer con esta cuenta?</p>
                                <ul class="list-group">
                                  <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($dueno->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></li>
                                  <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($dueno->emailUsuario, ENT_QUOTES, 'UTF-8'); ?></li>
                                </ul>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>

                                <a class="btn btn-danger" href="/src/controller/dueno/handle_validar_cuenta.php?estado=rechazado&id=<?php echo $dueno->idUsuario; ?>">
                                  Rechazar
                                </a>

                                <a class="btn btn-success" href="/src/controller/dueno/handle_validar_cuenta.php?estado=aceptado&id=<?php echo $dueno->idUsuario; ?>">
                                  Aceptar
                                </a>

                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } else { ?>
                        <div class="text-muted">Cuenta gestionada</div>
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