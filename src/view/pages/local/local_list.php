<?php
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";
require_once __DIR__ . "/../../../enums.php";


$tipo = getTipoUsuario();

$locales = showLocales();
$duenos = showDuenos();
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
          <h1 class="c-title">Locales</h1>
          <p class="c-subtitle">Revisá y administrá los locales registrados.</p>
        </div>

        <div class="row">
          <!-- Botón para crear nuevo local, solo visible para admin -->
          <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
            <div class="col-lg-12 col-4 my-1 mt-lg-3">
              <a href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>" class="c-btn-secondary-tonal">Crear Local</a>
            </div>
          <?php } ?>
          <div class="col-lg-12 col-4 my-1 mt-lg-0">
            <a href="<?php echo app_path(); ?>" class="c-btn-secondary-ghost">Volver al Menú</a>
          </div>
        </div>
      </aside>
    </div>

    <?php include "../../components/alerts.php"; ?>

    <!-- Lista de locales -->
    <?php if (empty($locales)) { ?>
      <section class="col-8">
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No hay locales registrados.</p>
        </div>
      </section>
    <?php } else { ?>
      <section class="col-lg-7 col-12">
        <div class="row c-list">
          <?php foreach ($locales as $l) {
            $modalId = 'editLocalModal_' . $l->idLocal;
            $localToEdit = $l;
          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5> <?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8') ?></h5>
                </div>
                <div class="col-lg-6 c-list-card-category">
                  <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
                    <span>Estado: <?php echo htmlspecialchars($l->estadoLocal, ENT_QUOTES, 'UTF-8') ?></span>
                  <?php } ?>
                </div>
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
                  <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
                    <div class="col-6 text-end">
                      <div class="c-list-cart-body-info-group">
                        <label class="c-list-cart-body-label">DUEÑO</label>
                        <span class="c-list-cart-body-date"><?php echo htmlspecialchars($l->usuario->nombreUsuario, ENT_QUOTES, 'UTF-8') ?></span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>

              <!-- Estado y botones de Editar y Eliminar solo visibles para admin -->
              <?php if ($tipo === TipoUsuario::ADMIN->value) { ?>
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

              <?php include __DIR__ . '/edit_local.php'; ?>
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