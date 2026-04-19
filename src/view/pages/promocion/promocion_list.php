<?php
require_once __DIR__ . "/../../../controller/promocion/show_promocion.php";
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/auth.php";

$tipo = getTipoUsuario();

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();

$promociones = showPromociones();
$locales = showLocales();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promociones</title>
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

  <main>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <h1>Promociones</h1>
        </div>
      </div>

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

      <?php if (empty($promociones)) { ?>
        <div class="row">
          <div class="col">
            <p>No hay promociones registradas.</p>
          </div>
        </div>
        <?php
      } else {
        foreach ($promociones as $p) {
        ?>
          <div class="row mt-3">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo htmlspecialchars($p->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                  </h5>

                  <p class="card-text">
                    Vigencia:
                    <?php echo $p->fechaDesdePromo->format('d/m/Y'); ?>
                    -
                    <?php echo $p->fechaHastaPromo->format('d/m/Y'); ?>
                  </p>

                  <p class="card-text">
                    Categoría cliente:
                    <?php echo htmlspecialchars($p->categoriaClientePromo, ENT_QUOTES, 'UTF-8'); ?>
                  </p>

                  <p class="card-text">
                    Días de la semana:
                    <?php
                    $dias = [];
                    foreach ($p->diasSemanaPromo as $d) {
                      $diasTexto = [
                        1 => "Lun",
                        2 => "Mar",
                        3 => "Mié",
                        4 => "Jue",
                        5 => "Vie",
                        6 => "Sáb",
                        7 => "Dom"
                      ];
                      $dias[] = $diasTexto[$d] ?? $d;
                    }
                    echo implode(", ", $dias);
                    ?>
                  </p>

                  <p class="card-text">
                    Estado de la promo:
                    <?php echo htmlspecialchars($p->estadoPromo, ENT_QUOTES, 'UTF-8'); ?>
                  </p>

                  <p class="card-text">
                    Local:
                    <?php echo htmlspecialchars($p->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                  </p>

                  <div class="d-flex justify-content-end">
                    <?php if ($tipo === "dueno") { ?>
                      <a href="<?php echo app_path('src/controller/promocion/handle_delete_promocion.php'); ?>?id=<?php echo htmlspecialchars($p->idPromo, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">
                        Eliminar
                      </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php }
      } ?>

      <?php if ($tipo === "dueno") { ?>
        <div class="container text-center">
          <div class="row mt-5">
            <div class="col">
              <a href="<?php echo app_path('src/view/pages/promocion/create_promocion.php'); ?>" class="btn btn-success">
                Crear Promoción
              </a>
            </div>
          </div>
        </div>
      <?php } ?>

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