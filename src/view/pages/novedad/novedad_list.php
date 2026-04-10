<?php
require_once __DIR__ . '/../../../controller/novedad/show_novedad.php';
require_once __DIR__ . '/../../../controller/auth.php';

$tipo = getTipoUsuario();
$novedades = showNovedades();
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
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>
  <main>
    <div class='container text-center'>
      <div class="row">
        <div class="col">
          <h1>Novedades</h1>
        </div>
      </div>
    </div>

    <?php if (empty($novedades)) { ?>
      <div class='row'>
        <div class='col'>
          <p>No hay novedades registradas.</p>
        </div>
      </div>
    <?php } else { ?>
      <?php foreach ($novedades as $n) { ?>
        <div class="row mt-3">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Codigo: <?php echo htmlspecialchars($n->codNovedad, ENT_QUOTES, 'UTF-8') ?></h5>
                <p class="card-text">Descripcion: <?php echo htmlspecialchars($n->textoNovedad, ENT_QUOTES, 'UTF-8') ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>

    <!-- Botón para crear nueva novedad, solo visible para admin -->
    <?php if ($tipo === "admin") { ?>
      <div class="container text-center">
        <div class='row mt-5'>
          <div class="col">
            <a href="/src/view/pages/novedad/novedad_create.php" class="btn btn-success">Crear Novedad</a>
          </div>
        </div>
      </div>
    <?php } ?>



  </main>



</body>

</html>