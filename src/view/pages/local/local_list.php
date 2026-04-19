<?php
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";

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
</head>

<body>

  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main>
    <div class="container-fluid">

      <!-- Sidebar de navegación -->
      <div class="row">
        <aside class="col-12 col-md-3 col-lg-2">
          <button
            class="btn btn-outline-dark d-md-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebarLocales"
            aria-expanded="false"
            aria-controls="sidebarLocales">
            Ver panel
          </button>

          <div class="collapse d-md-block" id="sidebarLocales">
            <div class="card text-start">
              <div class="card-body">
                <h5 class="card-title">Panel</h5>

                <!-- Botón para crear nuevo local, solo visible para admin -->
                <?php if ($tipo === "admin") { ?>
                  <div class="container text-center">
                    <div class="row">
                      <div class="col">
                        <a href="<?php echo app_path('src/view/pages/local/create_local.php'); ?>" class="btn btn-success">Crear Local</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <a href="<?php echo app_path(); ?>" class="btn btn-secondary">Volver al Menú</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </aside>

        <section class="col-12 col-md-9 col-lg-10">
          <div class="container text-center">
            <div class="row">
              <div class="col">
                <h1>Locales</h1>
              </div>
            </div>

            <?php include "../../components/alerts.php"; ?>

            <!-- Lista de locales -->
            <?php if (empty($locales)) { ?>
              <div class='row'>
                <div class='col'>
                  <p>No hay locales registrados.</p>
                </div>
              </div>
              <?php
            } else {
              foreach ($locales as $l) {
                $modalId = 'editLocalModal_' . $l->idLocal;
                $localToEdit = $l;
              ?>
                <div class='row'>
                  <div class='col'>
                    <div class='card'>
                      <div class='card-body'>
                        <h5 class='card-title'> <?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8') ?></h5>
                        <p class='card-text'>Ubicación: <?php echo htmlspecialchars($l->ubiLocal, ENT_QUOTES, 'UTF-8') ?></p>
                        <p class='card-text'>Rubro: <?php echo htmlspecialchars($l->rubroLocal, ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="card-text">Estado: <?php echo htmlspecialchars($l->estadoLocal, ENT_QUOTES, 'UTF-8') ?></p>
                        <!-- Dueño del Local y botones de Editar y Eliminar solo visibles para admin -->
                        <?php if ($tipo === "admin") { ?>
                          <p class='card-text'>Dueño: <?php echo htmlspecialchars($l->usuario->nombreUsuario, ENT_QUOTES, 'UTF-8') ?></p>
                          <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                            Editar
                          </button>
                          <a href="<?php echo app_path('src/controller/local/handle_logic_delete_local.php'); ?>?id=<?php echo htmlspecialchars($l->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">
                            Eliminar
                          </a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php include __DIR__ . '/edit_local.php'; ?>
            <?php
              }
            }
            ?>



  </main>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>