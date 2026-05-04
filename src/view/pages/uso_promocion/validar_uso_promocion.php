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

      <?php if (empty($usos)) { ?>
        <div class="alert alert-info mt-5 text-center">
          No hay solicitudes.
        </div>
      <?php } else { ?>
        <div class="row c-list">
          <?php foreach ($usos as $uso) {
            $estado = strtolower((string)$uso->estado);
          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5>
                    Cliente #<?php echo htmlspecialchars($uso->idCli); ?>
                    -
                    Promo #<?php echo htmlspecialchars($uso->idPromo); ?>
                  </h5>
                </div>

                <div class="col-lg-6 text-end">
                  <span class="c-list-card-category">
                    <?php echo strtoupper(htmlspecialchars($uso->estado)); ?>
                  </span>
                </div>
              </div>

              <div class="c-list-cart-body-container">
                <div class="row mb-4">
                  <div class="col-6">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA</label>
                      <span class="c-list-cart-body-date">
                        <?php echo $uso->fechaUso->format('d/m/Y'); ?>
                      </span>
                    </div>
                  </div>

                  <div class="col-6 text-end">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">LOCAL</label>
                      <span class="c-list-cart-body-date">
                        <?php echo htmlspecialchars($uso->promo->local->nombreLocal); ?>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">PROMOCIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($uso->promo->textoPromo); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <?php if ($estado === 'enviada') { ?>
                  <div class="col-md-6 col-12">
                    <a class="c-btn-danger-tonal"
                      href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>
                      ?estado=rechazada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                      Rechazar
                    </a>
                  </div>

                  <div class="col-md-6 col-12">
                    <a class="c-btn-secondary-tonal"
                      href="<?php echo app_path('src/controller/uso_promocion/handle_validar_uso_promocion.php'); ?>
                      ?estado=aceptada&id_cli=<?php echo $uso->idCli; ?>&id_promo=<?php echo $uso->idPromo; ?>">
                      Aceptar
                    </a>
                  </div>
                <?php } else { ?>
                  <div class="col-12 text-center c-list-cart-body-label">
                    Uso ya gestionado
                  </div>
                <?php } ?>
              </div>
            </article>
          <?php } ?>
        </div>
      <?php } ?>
    </section>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>