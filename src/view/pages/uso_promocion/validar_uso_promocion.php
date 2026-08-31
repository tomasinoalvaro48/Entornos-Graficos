<?php
require_once __DIR__ . "/../../../controller/uso_promocion/show_usos_promocion.php";

$agrupados = showUsosPromocionAgrupados();
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
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="row c-page-main">
    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Usos de promociones</h1>
          <p class="c-subtitle">Revisá y administrá las solicitudes de uso de promociones.</p>
        </div>

        <div class="col-12 my-1 mt-lg-3">
          <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
            Volver al menú
          </a>
        </div>
      </aside>
    </div>

    <section class="col-lg-7 col-12">
      <?php include __DIR__ . '/../../components/alerts.php'; ?>

      <?php if (empty($agrupados)) { ?>
        <div class="alert alert-info mt-5 text-center">
          No hay solicitudes.
        </div>
      <?php } else { ?>
        <div class="row c-list">
          <?php foreach ($agrupados as $idPromo => $grupo) {
            $promo = $grupo['promo'];
            $usosDePromo = $grupo['usos'];
          ?>
            <article class="col-12 accordion" id="accordionPromo<?php echo $idPromo; ?>">
              <div class="accordion-item c-accordion-item">
                <h2 class="accordion-header c-accordion-header">
                  <button class="accordion-button collapsed c-accordion-button" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePromo<?php echo $idPromo; ?>"
                    aria-expanded="false"
                    aria-controls="collapsePromo<?php echo $idPromo; ?>">
                    <div class="col-6">
                      <h5 class="c-list-card-title">
                        <?php
                        $texto = $promo->textoPromo;
                        echo htmlspecialchars(mb_strlen($texto, 'UTF-8') > 35 ? mb_substr($texto, 0, 35, 'UTF-8') . '...' : $texto);
                        ?>
                      </h5>
                    </div>
                    <div class="col-3 text-center">
                      <span class="c-list-cart-body-date">
                        <?php echo htmlspecialchars($promo->local->nombreLocal); ?>
                      </span>
                    </div>
                    <div class="col-3">
                      <span class="c-list-card-category">
                        <?php echo htmlspecialchars(count($usosDePromo)); ?> uso<?php echo count($usosDePromo) !== 1 ? 's' : ''; ?>
                      </span>
                    </div>
                  </button>
                </h2>
                <div id="collapsePromo<?php echo $idPromo; ?>" class="accordion-collapse collapse">
                  <div class="accordion-body c-accordion-body">

                    <div class="c-list-cart-body-container">
                      <div class="row mb-4">
                        <div class="col-6">
                          <div class="c-list-cart-body-info-group">
                            <label class="c-list-cart-body-label">FECHA DESDE</label>
                            <span class="c-list-cart-body-date">
                              <?php echo $promo->fechaDesdePromo ? $promo->fechaDesdePromo->format('d-m-Y') : 'N/A'; ?>
                            </span>
                          </div>
                        </div>

                        <div class="col-6 text-end">
                          <div class="c-list-cart-body-info-group">
                            <label class="c-list-cart-body-label">FECHA HASTA</label>
                            <span class="c-list-cart-body-date">
                              <?php echo $promo->fechaHastaPromo ? $promo->fechaHastaPromo->format('d-m-Y') : 'N/A'; ?>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="c-list-cart-body-desc-container">
                            <label class="c-list-cart-body-label">DESCRIPCIÓN</label>
                            <p class="c-list-cart-body-desc-text">
                              <?php echo htmlspecialchars($promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="c-list-cart-body-desc-container">
                            <label class="c-list-cart-body-label">DETALLE</label>
                            <p class="c-list-cart-body-desc-text">
                              <?php
                              $dias = [];
                              $diasTexto = [1 => "Lun", 2 => "Mar", 3 => "Mié", 4 => "Jue", 5 => "Vie", 6 => "Sáb", 7 => "Dom"];
                              foreach ($promo->diasSemanaPromo as $d) {
                                $dias[] = $diasTexto[$d] ?? $d;
                              }
                              ?>
                              <strong>Días que aplica:</strong> <?php echo implode(", ", $dias); ?> <br>
                              <strong>Local:</strong> <?php echo htmlspecialchars($promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?> <br>
                              <strong>Categoría de cliente:</strong> <?php echo htmlspecialchars($promo->categoriaClientePromo, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="c-table-container">
                      <table class="c-table">
                        <thead>
                          <tr>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($usosDePromo as $uso) {
                            $estado = strtolower((string)$uso->estado);
                            $estadoBadgeClass = 'text-bg-secondary';
                            if ($estado === 'enviada') {
                              $estadoBadgeClass = 'text-bg-warning';
                            } elseif ($estado === 'aceptada') {
                              $estadoBadgeClass = 'text-bg-success';
                            } elseif ($estado === 'rechazada') {
                              $estadoBadgeClass = 'text-bg-danger';
                            }
                          ?>
                            <tr>
                              <td><?php echo htmlspecialchars($uso->cliente->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                              <td><?php echo $uso->fechaUso->format('d-m-Y'); ?></td>
                              <td>
                                <span class="badge <?php echo $estadoBadgeClass; ?>">
                                  <?php echo strtoupper(htmlspecialchars($uso->estado, ENT_QUOTES, 'UTF-8')); ?>
                                </span>
                              </td>
                              <td>
                                <div class="row">
                                  <?php if ($estado === 'enviada') { ?>
                                    <div class="col-6">
                                      <a class="c-btn-primary c-table-btn-sm" href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>?estado=aceptada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                                        Aceptar
                                      </a>
                                    </div>
                                    <div class="col-6">
                                      <a class="c-btn-danger-tonal c-table-btn-sm" href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>?estado=rechazada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                                        Rechazar
                                      </a>
                                    </div>
                                  <?php } else { ?>
                                    <div class="col-12">
                                      <div class="c-text-muted">Uso gestionado</div>
                                    </div>
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </article>
          <?php } ?>
        </div>
      <?php } ?>
    </section>
  </main>

  <footer>
    <?php include_once __DIR__ . '/../../components/footer.php' ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>