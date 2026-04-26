<?php
require_once __DIR__ . '/../../../controller/novedad/show_novedad.php';
require_once __DIR__ . '/../../../controller/novedad/handle_update_novedad.php';
require_once __DIR__ . '/../../../controller/auth.php';


$tipo = getTipoUsuario();
if ($tipo === 'cliente') {
  $categoriaCliente = getCategoriaCliente();
  $novedades = showNovedadesByClientType($categoriaCliente);
} else {
  $novedades = showNovedades();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novedades</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>
  <main class="row c-page-main">
    <div class="col-md-3 col-12">
      <aside class=" c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Novedades</h1>
          <p class="c-subtitle">Revisá y administrá los avisos publicados para cada tipo de cliente.</p>
        </div>

        <div class="row">
          <!-- Botón para crear nueva novedad, solo visible para admin -->
          <?php if ($tipo === "admin") { ?>
            <div class="col-md-12 col-6">
              <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>">
                Crear Novedad
              </a>
            </div>
          <?php } ?>
          <div class="col-md-12 col-6">
            <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
              Volver al Menú
            </a>
          </div>
        </div>
      </aside>
    </div>
    <?php if (empty($novedades)) { ?>
      <section class="col-8">
        <p>No hay novedades registradas.</p>
      </section>
    <?php } else { ?>
      <section class="col-7">
        <div class="row c-list">
          <?php foreach ($novedades as $n) {
            $modalId = 'editNovedadModal_' . $n->codNovedad;
            $novedadToEdit = $n;

          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-md-6 c-list-card-title">
                  <h5>Novedad #<?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8') ?></h5>
                </div>
                <div class="col-md-6 c-list-card-category">
                  <span>Tipo de cliente: <?php echo htmlspecialchars(ucfirst($n->categoriaCliente), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
              </div>

              <div class="c-list-cart-body-container">
                <div class="row mb-4">
                  <div class="col-6">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA DESDE</label>
                      <span class="c-list-cart-body-date"><?php echo $n->fechaDesdeNovedad ? htmlspecialchars($n->fechaDesdeNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                    </div>
                  </div>
                  <div class="col-6 text-end">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA HASTA</label>
                      <span class="c-list-cart-body-date"><?php echo $n->fechaHastaNovedad ? htmlspecialchars($n->fechaHastaNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">DESCRIPCIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($n->textoNovedad, ENT_QUOTES, 'UTF-8') ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <?php if ($tipo === 'admin') { ?>
                <div class="row">
                  <div class="col-md-6">
                    <button
                      class="c-btn-secondary-tonal"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                      Editar
                    </button>
                  </div>
                  <div class="col-md-6">
                    <a class="c-btn-danger-tonal"
                      href="<?php echo app_path('src/controller/novedad/handle_delete_novedad.php'); ?>?id=<?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8'); ?>">
                      Eliminar
                    </a>
                  </div>
                </div>

              <?php } ?>
              <?php include __DIR__ . '/novedad_update.php'; ?>
            </article>
          <?php } ?>
        </div>
      </section>
    <?php } ?>

  </main>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>