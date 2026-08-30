<?php
require_once __DIR__ . "/../../../controller/uso_promocion/show_usos_cliente.php";

$usos = handleUsosClienteList();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Mis promociones</title>

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
    <?php include __DIR__ . '/../../components/alerts.php'; ?>

    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Mis usos de promociones</h1>
          <p class="c-subtitle">
            Revisá el estado de las promociones que solicitaste.
          </p>
        </div>

        <div class="row">
          <form action="" method="POST" class="c-form-layout">
            <div class="row">
              <div class="col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    name="fecha_desde_uso"
                    value="<?php echo $_POST['fecha_desde_uso'] ?? ''; ?>">
                  <label class="c-form-label">Fecha Desde</label>
                </div>
              </div>

              <div class="col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    name="fecha_hasta_uso"
                    value="<?php echo $_POST['fecha_hasta_uso'] ?? ''; ?>">
                  <label class="c-form-label">Fecha Hasta</label>
                </div>
              </div>

              <div class="col-12 my-1">
                <div class="c-form-field">
                  <select class="c-form-input c-form-input-select" name="estado_uso">
                    <option value="">Todos los estados</option>
                    <option value="enviada" <?php echo (($_POST['estado_uso'] ?? '') === 'enviada') ? 'selected' : ''; ?>>Enviada</option>
                    <option value="aceptada" <?php echo (($_POST['estado_uso'] ?? '') === 'aceptada') ? 'selected' : ''; ?>>Aceptada</option>
                    <option value="rechazada" <?php echo (($_POST['estado_uso'] ?? '') === 'rechazada') ? 'selected' : ''; ?>>Rechazada</option>
                  </select>
                  <label class="c-form-label">Estado</label>
                </div>
              </div>

              <div class="col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="text"
                    class="c-form-input"
                    name="local"
                    placeholder=" "
                    value="<?php echo $_POST['local'] ?? ''; ?>">
                  <label class="c-form-label">Local</label>
                </div>
              </div>

              <div class="col-12 my-1">
                <button type="submit" name="botonFiltrarUsos" class="c-btn-primary">
                  Filtrar
                </button>
              </div>

              <div class="col-12 my-1">
                <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/uso_promocion/mis_usos_cliente.php'); ?>">
                  Limpiar filtros
                </a>
              </div>
            </div>
          </form>

          <div class="col-12 my-1">
            <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
              Volver al menú
            </a>
          </div>
        </div>
      </aside>
    </div>

    <?php if (empty($usos)) { ?>
      <section class="col-lg-7 col-12">
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No solicitaste usar promociones.</p>
        </div>
      </section>
    <?php } else { ?>
      <section class="col-lg-7 col-12">
        <div class="row c-list">
          <?php foreach ($usos as $uso) {
            $estado = strtolower((string)$uso->estado);
            $estadoTexto = strtoupper(htmlspecialchars($uso->estado, ENT_QUOTES, 'UTF-8'));

            $estadoColor = '#a8add0';

            if ($estado === 'enviada') {
              $estadoColor = '#ffc107';
            } else if ($estado === 'aceptada') {
              $estadoColor = '#28a745';
            } else if ($estado === 'rechazada') {
              $estadoColor = '#ef4444';
            }
          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5>Promo #<?php echo htmlspecialchars($uso->idPromo, ENT_QUOTES, 'UTF-8'); ?></h5>
                </div>

                <div class="col-lg-6 text-end">
                  <span class="c-list-card-category" style="background-color: <?php echo $estadoColor ?>;">
                    <?php echo $estadoTexto; ?>
                  </span>
                </div>
              </div>

              <div class="c-list-cart-body-container">
                <div class="row mb-4">
                  <div class="col-6">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA DE USO</label>
                      <span class="c-list-cart-body-date">
                        <?php echo htmlspecialchars($uso->fechaUso->format('d/m/Y'), ENT_QUOTES, 'UTF-8'); ?>
                      </span>
                    </div>
                  </div>

                  <div class="col-6 text-end">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">LOCAL</label>
                      <span class="c-list-cart-body-date">
                        <?php echo htmlspecialchars($uso->promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">PROMOCIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($uso->promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">VIGENCIA</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php
                        echo htmlspecialchars($uso->promo->fechaDesdePromo->format('d/m/Y'), ENT_QUOTES, 'UTF-8');
                        echo " - ";
                        echo htmlspecialchars($uso->promo->fechaHastaPromo->format('d/m/Y'), ENT_QUOTES, 'UTF-8');
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          <?php } ?>
        </div>
      </section>
    <?php } ?>
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