<?php
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";

$duenos = showDuenos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Local</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>

  <div class="container text-center">
    <div class="row">
      <div class="col">
        <h1>Crear Local</h1>
      </div>
    </div>

    <?php include "../../components/alerts.php"; ?>

    <div class="row">
      <div class="col">

        <!-- ------Formulario para crear un nuevo local------ -->

        <!--
          <form enctype="multipart/form-data" action="<?php echo app_path('src/controller/local/handle_create_local.php'); ?>" method="POST">
        -->

        <form action="<?php echo app_path('src/controller/local/handle_create_local.php'); ?>" method="POST">
          <!-- Campo para el nombre del local -->
          <div>
            <label for="nombre_local" class="form-label">Nombre del Local</label>
            <input type="text" class="form-control" id="nombre_local" name="nombre_local" required>
          </div>

          <!-- Campo para la descripción del local -->
          <div>
            <label for="ubicacion_local" class="form-label">Ubicación del Local</label>
            <input type="text" class="form-control" id="ubicacion_local" name="ubicacion_local" required>
          </div>

          <!-- Campo para el rubro del local -->
          <div>
            <label for="rubro_local" class="form-label">Rubro del Local</label>
            <input type="text" class="form-control" id="rubro_local" name="rubro_local" required>
          </div>

          <!-- Campo para seleccionar el dueño del local -->
          <div>
            <label for="dueno_local" class="form-label">Dueño del Local</label>
            <select class="form-control" id="dueno_local" name="dueno_local" required>
              <option value="">Seleccionar un dueño</option>
              <?php foreach ($duenos as $d) {
                echo ("
                <option value='" . htmlspecialchars($d->idUsuario, ENT_QUOTES, 'UTF-8') . "'>
                  " . htmlspecialchars($d->nombreUsuario, ENT_QUOTES, 'UTF-8') . "
                </option>"
                );
              } ?>
            </select>
          </div>

          <!--
      <!-- Campo para subir la imagen del local 
      <div>
          <label for="imagen_local" class="form-label">Imagen del Local</label>
          <!-- MAX_FILE_SIZE debe preceder al campo input de tipo file 
          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
          <!-- El nombre del elemento input determina el nombre en el array $_FILES 
          <input id="imagen_local" name="imagen_local" type="file" class="form-control" accept="image/*" />
      </div>
          -->

          <button type="submit" class="btn btn-primary" id="botonCrear" name="botonCrear">Crear Local</button>
        </form>

        <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="btn btn-secondary">Volver a la Lista de Locales</a>
      </div>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>