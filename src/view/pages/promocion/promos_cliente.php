<?php
require_once __DIR__ . "/../../../controller/promocion/show_promos_cliente.php";
require_once __DIR__ . "/../../../controller/auth.php";

$tipo = getTipoUsuario();

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();

$promos = [];

if (isset($_GET['id_local'])) {
  $promos = getPromosCliente($_GET['id_local']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Promociones del Local</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous"
  />
  
  <link
    rel="stylesheet"
    href="../styles/styles.css"
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
          <h1>Buscar promociones</h1>
        </div>
      </div>

      <form method="GET" class="mt-4">
        <div class="row justify-content-center">
          <div class="col-4">
            <input
              type="number"
              name="id_local"
              class="form-control"
              placeholder="Código del local"
              required
            >
          </div>
          <div class="col-2">
            <button type="submit" class="btn btn-primary">
              Buscar
            </button>
          </div>
        </div>
      </form>

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

      <?php if (isset($_GET['id_local'])) { ?>
        <?php if (empty($promos)) { ?>
          <div class="row">
            <div class="col">
              <p>No hay promociones disponibles para este local.</p>
            </div>
          </div>
          <?php
        } else {
          foreach ($promos as $p) {
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
                      $diasTexto = [
                        1 => "Lun",
                        2 => "Mar",
                        3 => "Mié",
                        4 => "Jue",
                        5 => "Vie",
                        6 => "Sáb",
                        7 => "Dom"
                      ];
                      $dias = [];

                      foreach ($p->diasSemanaPromo as $d) {
                        $dias[] = $diasTexto[$d] ?? $d;
                      }

                      echo implode(", ", $dias);
                      ?>
                    </p>

                    <p class="card-text">
                      Local:
                      <?php echo htmlspecialchars($p->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <form
                      method="POST"
                      action="<?php echo app_path('src/controller/promocion/usar_promocion.php'); ?>"
                    >
                      <input
                        type="hidden"
                        name="id_promo"
                        value="<?php echo htmlspecialchars($p->idPromo, ENT_QUOTES, 'UTF-8'); ?>"
                      >

                      <button type="submit" class="btn btn-success">
                        Usar promoción
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php }
        } ?>
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