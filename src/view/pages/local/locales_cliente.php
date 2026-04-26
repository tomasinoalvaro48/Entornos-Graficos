<?php
require_once __DIR__ . "/../../../controller/local/show_local_cliente.php";

$rubro = $_GET['rubro'] ?? null;
$locales = getLocalesCliente($rubro);
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
    crossorigin="anonymous"
  />

  <link
    rel="stylesheet"
    href="../../styles/styles.css"
  />
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

      <form method="GET" class="row mt-4 justify-content-center">
        <div class="col-4">
          <input
            type="text"
            name="rubro"
            class="form-control"
            placeholder="Filtrar por rubro (ej: indumentaria)"
            value="<?php echo htmlspecialchars($rubro ?? '', ENT_QUOTES, 'UTF-8'); ?>"
          >
        </div>

        <div class="col-2">
          <button type="submit" class="btn btn-primary">
            Filtrar
          </button>
        </div>

        <div class="col-2">
          <a href="locales_cliente.php" class="btn btn-secondary">
            Limpiar
          </a>
        </div>
      </form>

      <div class="mt-4">
        <?php if (empty($locales)) { ?>
          <p class="text-center">No hay locales.</p>
        <?php } else { ?>
          <?php foreach ($locales as $l) {
            if ($l->estadoLocal !== 'Activo') {
              continue;
            }
          ?>
            <div class="card mb-3">
              <div class="card-body">

                <h5 class="card-title">
                  <?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                </h5>

                <p class="card-text">
                  Ubicación:
                  <?php echo htmlspecialchars($l->ubiLocal, ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p class="card-text">
                  Rubro:
                  <?php echo htmlspecialchars($l->rubroLocal, ENT_QUOTES, 'UTF-8'); ?>
                </p>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>

      <div class="container text-center">
        <div class="row mt-5">
          <div class="col">
            <a href="<?php echo app_path(); ?>" class="btn btn-secondary">
              Volver al menú
            </a>
          </div>
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