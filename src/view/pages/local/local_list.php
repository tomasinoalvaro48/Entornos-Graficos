<?php
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();

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
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>

  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <h1>Locales</h1>
        </div>
      </div>


      <!-- Mostrar mensaje de error si existe -->
      <?php
      if ($error) { ?>
        <div class="row mt-3">
          <div class="col">
            <div class="alert alert-danger" role="alert">
              <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8');
              ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Mostrar mensaje de éxito si existe -->
      <?php if ($success) { ?>
        <div class="row mt-3">
          <div class="col">
            <div class="alert alert-success" role="alert">
              <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8');
              unset($success); ?>
            </div>
          </div>
        </div>
      <?php } ?>

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
          <div class='row mt-3'>
            <div class='col'>
              <div class='card'>
                <div class='card-body'>
                  <h5 class='card-title'> <?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8') ?></h5>
                  <p class='card-text'>Ubicación: <?php echo htmlspecialchars($l->ubiLocal, ENT_QUOTES, 'UTF-8') ?></p>
                  <p class='card-text'>Rubro: <?php echo htmlspecialchars($l->rubroLocal, ENT_QUOTES, 'UTF-8') ?></p>
                  <p class='card-text'>Dueño: <?php echo htmlspecialchars($l->usuario->nombreUsuario, ENT_QUOTES, 'UTF-8') ?></p>
                  <div class='d-flex justify-content-end'>
                    <button
                      type="button"
                      class="btn btn-primary me-2"
                      data-bs-toggle="modal"
                      data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>">
                      Editar
                    </button>
                    <a href="/src/controller/local/handle_delete_local.php?id=<?php echo htmlspecialchars($l->idLocal, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">Eliminar</a>
                  </div>
                </div>
              </div>
            </div>
            <?php include __DIR__ . '/edit_local.php'; ?>
        <?php
        }
      }
        ?>
          </div>

          <div class="container text-center">
            <div class="row mt-5">
              <div class="col">
                <a href="/src/view/pages/local/create_local.php" class="btn btn-success">Crear Local</a>
              </div>
            </div>
          </div>

          <div class="container text-center">
            <div class="row mt-5">
              <div class="col">
                <a href="/" class="btn btn-secondary">Volver al Menú</a>
              </div>
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