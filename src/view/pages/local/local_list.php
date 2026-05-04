<?php
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/auth.php";
require_once __DIR__ . "/../../../enums.php";

$tipo = getTipoUsuario();
// ----- Filtro -----
$locales = handleLocalesList();

// Condiciones para mostrar botones e info según tipo de usuario
$isAdmin = $tipo === TipoUsuario::ADMIN->value;
$isDueno = $tipo === TipoUsuario::DUENO->value;
$canManage = $isAdmin || $isDueno;

// ----- Paginacion -----
$localesPerPage = 6;
$totalLocales = count($locales);
$totalPages = (int) ceil($totalLocales / $localesPerPage);
$currentPage = 1; // Primera página por default

if (isset($_POST['page']) && $totalPages > 0) {
  $currentPage = (int) $_POST['page'];
  // Para que no llegue valores menores a 1 o mayores a totalPages
  $currentPage = max(1, min($currentPage, $totalPages));
}

$startIndex = ($currentPage - 1) * $localesPerPage;
$localesPage = $totalLocales > 0 ? array_slice($locales, $startIndex, $localesPerPage) : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locales</title>
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

    <!-- ------------- Alertas ------------- -->
    <?php include "../../components/alerts.php"; ?>

    <!-- ------------- Filtros y acciones ------------- -->
    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Locales</h1>
          <p class="c-subtitle">
            <?php
            if ($tipo === TipoUsuario::ADMIN->value) {
              echo "Revisá y administrá los locales registrados.";
            } else if ($tipo === TipoUsuario::DUENO->value) {
              echo "Revisá tus locales.";
            } else {
              echo "Revisá todos los locales disponibles.";
            }
            ?>
          </p>
        </div>

        <div class="row">
          <form action="" method="POST" class="c-form-layout">
            <div class="row">

              <!-- Filtro de nombre -->
              <div class="col-lg-12 col-md-4 col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="text"
                    class="c-form-input"
                    id="nombre_local"
                    name="nombre_local"
                    placeholder=" "
                    value="<?php echo isset($_POST['nombre_local']) ? htmlspecialchars($_POST['nombre_local'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="nombre_local">Nombre del Local</label>
                </div>
              </div>

              <!-- Filtro de rubro -->
              <div class="col-lg-12 col-md-4 col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="text"
                    class="c-form-input"
                    id="rubro_local"
                    name="rubro_local"
                    placeholder=" "
                    value="<?php echo isset($_POST['rubro_local']) ? htmlspecialchars($_POST['rubro_local'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="rubro_local">Rubro</label>
                </div>
              </div>

              <!-- Filtro de estado solo para admin y dueño -->
              <?php if ($canManage) {  ?>
                <div class="col-lg-12 col-md-4 col-12 my-1">
                  <div class="c-form-field">
                    <select
                      class="c-form-input c-form-input-select"
                      id="estado_elim_local"
                      name="estado_elim_local">
                      <option value="">Cualquier estado</option>
                      <option value="activo" <?php echo (isset($_POST['estado_elim_local']) && $_POST['estado_elim_local'] === 'activo') ? 'selected' : ''; ?>>Activo</option>
                      <option value="eliminado" <?php echo (isset($_POST['estado_elim_local']) && $_POST['estado_elim_local'] === 'eliminado') ? 'selected' : ''; ?>>Eliminado</option>
                    </select>
                    <label class="c-form-label" for="estado_elim_local">Estado</label>
                  </div>
                </div>
              <?php } ?>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <button type="submit" class="c-btn-primary" id="botonFiltrarLocales" name="botonFiltrarLocales">
                  Filtrar
                </button>
              </div>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>">
                  Limpiar filtros
                </a>
              </div>

              <!-- Botón para crear nuevo local, solo visible para admin -->
              <?php if ($isAdmin) { ?>
                <div class="col-lg-12 col-md-4 col-12 my-1 mt-lg-0">
                  <a href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>" class="c-btn-secondary-tonal">Crear Local</a>
                </div>
              <?php } ?>

              <div class="col-lg-12 col-md-4 col-12 my-1 mt-lg-0">
                <a href="<?php echo app_path(); ?>" class="c-btn-secondary-ghost">
                  Volver al menú
                </a>
              </div>
            </div>
          </form>
        </div>
      </aside>
    </div>

    <!-- ------------- Lista de locales ------------- -->
    <!-- No hay locales -->
    <?php if ($totalLocales === 0) { ?>
      <section class="col-8">
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No hay locales registrados.</p>
        </div>
      </section>

      <!-- Si hay locales -->
    <?php } else { ?>
      <section class="col-lg-7 col-12">
        <div class="row c-list">
          <?php foreach ($localesPage as $l) {
            $modalId = 'editLocalModal_' . $l->idLocal;
            $localToEdit = $l;
          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5> <?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8') ?></h5>
                </div>
                <!-- Estado solo para admin y dueño -->
                <?php if ($canManage) { ?>
                  <div class="col-lg-6 c-list-card-category">
                    <span>Estado: <?php echo htmlspecialchars($l->estadoLocal, ENT_QUOTES, 'UTF-8') ?></span>
                  </div>
                <?php } ?>

              </div>

              <div class="c-list-cart-body-container">
                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">UBICACIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($l->ubiLocal, ENT_QUOTES, 'UTF-8') ?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="row mb-4 mt-3">
                  <div class="col-6">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">RUBRO</label>
                      <span class="c-list-cart-body-date"><?php echo htmlspecialchars($l->rubroLocal, ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                  </div>

                  <!-- Dueño solo para admin -->
                  <?php if ($isAdmin) { ?>
                    <div class="col-6 text-end">
                      <div class="c-list-cart-body-info-group">
                        <label class="c-list-cart-body-label">DUEÑO</label>
                        <span class="c-list-cart-body-date"><?php echo htmlspecialchars($l->usuario->nombreUsuario, ENT_QUOTES, 'UTF-8') ?></span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>

              <!-- Estado y botones de Editar y Eliminar solo para admin -->
              <?php if ($isAdmin) { ?>
                <div class="row">
                  <div class="col-lg-6">
                    <button
                      type="button"
                      class="c-btn-secondary-tonal"
                      data-bs-toggle="modal"
                      data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                      Editar
                    </button>
                  </div>
                  <div class="col-lg-6">
                    <a href="<?php echo app_path('src/controller/local/handle_logic_delete_local.php'); ?>?id=<?php echo htmlspecialchars($l->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="c-btn-danger-tonal">
                      Eliminar
                    </a>
                  </div>
                </div>
              <?php } ?>

              <!-- Modal de edición solo para admin -->
              <?php include __DIR__ . '/edit_local.php'; ?>
            </article>
          <?php } ?>
        </div>

        <!-- -------------- Paginación -------------- -->
        <nav aria-label="Navegación de páginas">
          <form method="POST" class="d-flex justify-content-center">
            <?php if (isset($_POST['botonFiltrarLocales'])) { ?>
              <input type="hidden" name="botonFiltrarLocales" value="1">
            <?php } ?>
            <?php if (isset($_POST['nombre_local'])) { ?>
              <input type="hidden" name="nombre_local" value="<?php echo htmlspecialchars($_POST['nombre_local'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php } ?>
            <?php if (isset($_POST['rubro_local'])) { ?>
              <input type="hidden" name="rubro_local" value="<?php echo htmlspecialchars($_POST['rubro_local'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php } ?>
            <?php if (isset($_POST['estado_elim_local'])) { ?>
              <input type="hidden" name="estado_elim_local" value="<?php echo htmlspecialchars($_POST['estado_elim_local'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php } ?>
            <ul class="pagination justify-content-center">
              <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                <?php if ($currentPage <= 1) { ?>
                  <span class="page-link">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                  </span>
                <?php } else { ?>
                  <button type="submit" class="page-link" name="page" value="<?php echo $currentPage - 1; ?>">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                  </button>
                <?php } ?>
              </li>

              <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                  <?php if ($i === $currentPage) { ?>
                    <span class="page-link"><?php echo $i; ?></span>
                  <?php } else { ?>
                    <button type="submit" class="page-link" name="page" value="<?php echo $i; ?>">
                      <?php echo $i; ?>
                    </button>
                  <?php } ?>
                </li>
              <?php } ?>

              <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                <?php if ($currentPage >= $totalPages) { ?>
                  <span class="page-link">
                    <span class="sr-only">Siguiente</span>
                    <span aria-hidden="true">&raquo;</span>
                  </span>
                <?php } else { ?>
                  <button type="submit" class="page-link" name="page" value="<?php echo $currentPage + 1; ?>">
                    <span class="sr-only">Siguiente</span>
                    <span aria-hidden="true">&raquo;</span>
                  </button>
                <?php } ?>
              </li>
            </ul>
          </form>
        </nav>
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