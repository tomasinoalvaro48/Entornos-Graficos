<?php
require_once __DIR__ . '/../../../controller/novedad/show_novedad.php';
require_once __DIR__ . '/../../../controller/novedad/handle_update_novedad.php';
require_once __DIR__ . '/../../../controller/auth.php';
require_once __DIR__ . '/../../../enums.php';

/*filtro*/
$tipo = getTipoUsuario();
$novedades = handleNovedadesList();

// ----- Paginacion -----
$novedadesPerPage = 6;
$totalNovedades = count($novedades);
$totalPages = (int) ceil($totalNovedades / $novedadesPerPage);
$currentPage = 1;

if (isset($_POST['page']) && $totalPages > 0) {
  $currentPage = (int) $_POST['page'];
  $currentPage = max(1, min($currentPage, $totalPages));
}

$startIndex = ($currentPage - 1) * $novedadesPerPage;
$novedadesPage = $totalNovedades > 0 ? array_slice($novedades, $startIndex, $novedadesPerPage) : [];
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
    <?php include_once __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="row c-page-main">

    <?php include __DIR__ . '/../../components/alerts.php' ?>

    <div class="col-lg-3 col-12">
      <aside class=" c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Novedades</h1>
          <p class="c-subtitle">
            <?php
            if ($tipo === TipoUsuario::ADMIN->value) {
              echo "Revisá y administrá las novedades publicadas para cada tipo de cliente.";
            } else {
              echo "Revisá las novedades.";
            }
            ?>
          </p>
        </div>

        <div class="row">

          <form action="" method="POST" class="c-form-layout">
            <div class="row">
              <div class="col-lg-12 col-md-4 col-12 my-1">

                <div class=" c-form-field ">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    id="fecha_desde_novedad"
                    name="fecha_desde_novedad"
                    placeholder=" "
                    value="<?php echo isset($_POST['fecha_desde_novedad']) ? htmlspecialchars($_POST['fecha_desde_novedad'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="fecha_desde_novedad">Fecha Desde</label>
                </div>
              </div>
              <div class="col-lg-12 col-md-4 col-12 my-1">
                <div class=" c-form-field ">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    id="fecha_hasta_novedad"
                    name="fecha_hasta_novedad"
                    placeholder=" "
                    value="<?php echo isset($_POST['fecha_hasta_novedad']) ? htmlspecialchars($_POST['fecha_hasta_novedad'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="fecha_hasta_novedad">Fecha Hasta</label>
                </div>
              </div>
              <!-- Filtro por categoría de cliente -->
              <?php if ($tipo === TipoUsuario::ADMIN->value) {  ?>
                <div class="col-lg-12 col-md-4 col-12 my-1">
                  <div class="c-form-field">
                    <select
                      class="c-form-input c-form-input-select"
                      id="categoria_cliente"
                      name="categoria_cliente">
                      <option value="">Seleccione una Categoría</option>
                      <option value="inicial" <?php echo (isset($_POST['categoria_cliente']) && $_POST['categoria_cliente'] === 'inicial') ? 'selected' : ''; ?>>Inicial</option>
                      <option value="medium" <?php echo (isset($_POST['categoria_cliente']) && $_POST['categoria_cliente'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                      <option value="premium" <?php echo (isset($_POST['categoria_cliente']) && $_POST['categoria_cliente'] === 'premium') ? 'selected' : ''; ?>>Premium</option>
                    </select>
                    <label class="c-form-label" for="categoria_cliente">Categoría de Cliente</label>
                  </div>


                </div>
              <?php } ?>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <button type="submit" class="c-btn-primary" id="botonFiltrarNovedades" name="botonFiltrarNovedades">Filtrar</button>
              </div>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>">
                  Limpiar filtros
                </a>
              </div>
          </form>

          <!-- Botón para crear nueva novedad, solo visible para admin -->
          <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
            <div class="col-lg-12 col-md-4 col-12 my-1 mt-lg-3">
              <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/novedad/novedad_create.php'); ?>">
                Crear Novedad
              </a>
            </div>
          <?php } ?>
          <div class="col-lg-12 col-md-4 col-12 my-1 mt-lg-0">
            <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
              Volver al menú
            </a>
          </div>
        </div>
    </div>
    </aside>
    </div>
    <?php if ($totalNovedades === 0) { ?>
      <section class="col-8">
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No hay novedades registradas.</p>
        </div>
      </section>
    <?php } else { ?>
      <section class="col-lg-7 col-12 ">
        <div class="row c-list">
          <?php foreach ($novedadesPage as $n) {
            $modalId = 'editNovedadModal_' . $n->codNovedad;
            $novedadToEdit = $n;

          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5>Novedad #<?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8') ?></h5>
                </div>
                <div class="col-lg-6 c-list-card-category">
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

              <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <button
                      class="c-btn-secondary-tonal"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                      Editar
                    </button>
                  </div>
                  <div class="col-lg-6 col-12">
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

        <?php if ($totalPages > 1) { ?>
          <nav aria-label="Navegación de páginas">
            <form method="POST" class="d-flex justify-content-center">
              <?php if (isset($_POST['botonFiltrarNovedades'])) { ?>
                <input type="hidden" name="botonFiltrarNovedades" value="1">
              <?php } ?>
              <?php if (isset($_POST['fecha_desde_novedad'])) { ?>
                <input type="hidden" name="fecha_desde_novedad" value="<?php echo htmlspecialchars($_POST['fecha_desde_novedad'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php } ?>
              <?php if (isset($_POST['fecha_hasta_novedad'])) { ?>
                <input type="hidden" name="fecha_hasta_novedad" value="<?php echo htmlspecialchars($_POST['fecha_hasta_novedad'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php } ?>
              <?php if (isset($_POST['categoria_cliente'])) { ?>
                <input type="hidden" name="categoria_cliente" value="<?php echo htmlspecialchars($_POST['categoria_cliente'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php } ?>
              <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                  <?php if ($currentPage <= 1) { ?>
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                  <?php } else { ?>
                    <button type="submit" class="page-link" name="page" value="<?php echo $currentPage - 1; ?>">
                      <span aria-hidden="true">&laquo;</span>
                    </button>
                  <?php } ?>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                  <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                    <?php if ($i === $currentPage) { ?>
                      <span class="page-link"><?php echo $i; ?></span>
                    <?php } else { ?>
                      <button type="submit" class="page-link" name="page" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php } ?>
                  </li>
                <?php } ?>

                <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                  <?php if ($currentPage >= $totalPages) { ?>
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                  <?php } else { ?>
                    <button type="submit" class="page-link" name="page" value="<?php echo $currentPage + 1; ?>">
                      <span aria-hidden="true">&raquo;</span>
                    </button>
                  <?php } ?>
                </li>
              </ul>
            </form>
          </nav>
        <?php } ?>
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