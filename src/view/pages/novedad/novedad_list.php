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
  <main class="c-novedad-page">
    <div class="c-novedad-layout">
      <aside class="c-novedad-aside">
        <div class="c-novedad-aside__hero text-center">
          <p class="c-novedad-aside-kicker">Panel de novedades</p>
          <h1 class="c-novedad-aside-title">Novedades</h1>
          <p class="c-novedad-aside-subtitle">Revisá y administrá los avisos publicados para cada tipo de cliente.</p>
        </div>

        <div class="c-novedad-aside-actions">
          <!-- Botón para crear nueva novedad, solo visible para admin -->
          <?php if ($tipo === "admin") { ?>
            <a href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>" class="btn btn-success c-novedad-aside-btn">
              Crear Novedad
            </a>
          <?php } ?>

          <a href="<?php echo app_path(); ?>" class="btn btn-secondary c-novedad-aside-btn">
            Volver al Menú
          </a>
        </div>
      </aside>

      <?php if (empty($novedades)) { ?>
        <section class="c-novedad-list">
          <p>No hay novedades registradas.</p>
        </section>
      <?php } else { ?>
        <section class="c-novedad-list">
          <?php foreach ($novedades as $n) {
            $modalId = 'editNovedadModal_' . $n->codNovedad;
            $novedadToEdit = $n;

          ?>
            <article class="c-novedad-item">
              <div class="card cg-card-container">
                <div class="card-body cg-card">
                  <div class="cg-card-header">
                    <h5 class="card-title">Codigo: <?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8') ?></h5>
                    <span class="cg-card-badge">Tipo de cliente: <?php echo htmlspecialchars(ucfirst($n->categoriaCliente), ENT_QUOTES, 'UTF-8') ?></span>
                  </div>

                  <div class="cg-card-body-content">
                    <div class="cg-card-dates">
                      <div class="cg-card-date-item">
                        <span class="cg-card-date-label">Fecha Desde:</span>
                        <span class="cg-card-date-value"><?php echo $n->fechaDesdeNovedad ? htmlspecialchars($n->fechaDesdeNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                      </div>
                      <div class="cg-card-date-item">
                        <span class="cg-card-date-label">Fecha Hasta:</span>
                        <span class="cg-card-date-value"><?php echo $n->fechaHastaNovedad ? htmlspecialchars($n->fechaHastaNovedad->format('Y-m-d'), ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                      </div>
                    </div>

                    <div class="cg-card-divider"></div>

                    <div class="cg-card-desc">
                      <?php echo htmlspecialchars($n->textoNovedad, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                  </div>

                  <?php if ($tipo === 'admin') { ?>
                    <div class="cg-card-actions">
                      <button
                        type="button"
                        class="btn cg-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                        Editar
                      </button>
                      <a
                        class="btn cg-btn"
                        href="<?php echo app_path('src/controller/novedad/handle_delete_novedad.php'); ?>?id=<?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8'); ?>">
                        Eliminar
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <?php include __DIR__ . '/novedad_update.php'; ?>
              </div>
            </article>


          <?php } ?>
        </section>
      <?php } ?>
    </div>
  </main>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>