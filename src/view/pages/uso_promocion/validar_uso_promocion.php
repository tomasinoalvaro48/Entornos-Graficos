<?php
require_once __DIR__ . "/../../../controller/uso_promocion/show_usos_promocion.php";

$usos = showUsosPromocion();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Validar uso de promociones</title>
  
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous"
  />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="container">
    <div class="row">
      <div class="col">
        <h1 class="text-center">Solicitudes de uso de promociones</h1>
      </div>
    </div>

    <?php include __DIR__ . '/../../components/alerts.php'; ?>

    <div class="row">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th>Cliente</th>
                <th>Promo</th>
                <th>Local</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>

            <tbody>
              <?php if (empty($usos)) { ?>
                <tr>
                  <td colspan="5" class="text-center">No hay solicitudes.</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($usos as $uso) {
                  $estado = strtolower((string)$uso->estado);
                  $estadoBadgeClass = 'text-bg-secondary';

                  if ($estado === 'enviada') {
                    $estadoBadgeClass = 'text-bg-warning';
                  } else if ($estado === 'aceptada') {
                    $estadoBadgeClass = 'text-bg-success';
                  } else if ($estado === 'rechazada') {
                    $estadoBadgeClass = 'text-bg-danger';
                  }

                  $modalId = 'modal-validar-uso-' . $uso->idCli . '-' . $uso->idPromo;
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($uso->idCli, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($uso->promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($uso->promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($uso->fechaUso->format('d/m/Y'), ENT_QUOTES, 'UTF-8'); ?></td>

                    <td>
                      <span class="badge <?php echo $estadoBadgeClass; ?>">
                        <?php echo strtoupper(htmlspecialchars($uso->estado, ENT_QUOTES, 'UTF-8')); ?>
                      </span>
                    </td>

                    <td>
                      <?php if ($uso->estado === 'enviada') { ?>
                        <button
                          type="button"
                          class="btn btn-sm btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                          Gestionar uso de promoción
                        </button>

                        <div class="modal fade" id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Validar uso de promoción</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>

                              <div class="modal-body">
                                <p class="mb-3">¿Qué desea hacer con este uso de promoción?</p>

                                <ul class="list-group">
                                  <li class="list-group-item">
                                    <strong>ID Cliente:</strong>
                                    <?php echo htmlspecialchars($uso->idCli, ENT_QUOTES, 'UTF-8'); ?>
                                  </li>

                                  <li class="list-group-item">
                                    <strong>ID Promo:</strong>
                                    <?php echo htmlspecialchars($uso->idPromo, ENT_QUOTES, 'UTF-8'); ?>
                                  </li>

                                  <li class="list-group-item">
                                    <strong>Fecha uso promo:</strong>
                                    <?php echo htmlspecialchars($uso->fechaUso->format('d/m/Y'), ENT_QUOTES, 'UTF-8'); ?>
                                  </li>
                                </ul>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>

                                <a class="btn btn-danger"
                                  href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>?estado=rechazada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                                  Rechazar
                                </a>

                                <a class="btn btn-success"
                                  href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>?estado=aceptada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                                  Aceptar
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } else { ?>
                        <span class="text-muted">Uso de promo gestionado</span>
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
        <a href="<?php echo app_path(); ?>" class="btn btn-secondary">Volver al menú</a>
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