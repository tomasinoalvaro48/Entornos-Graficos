<?php
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../../controller/auth.php";
require_once __DIR__ . "/../../../enums.php";

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

  <header>
    <?php include_once __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="c-page-main align-items-center">
    <section class="c-card" aria-label="Crear Local">
      <?php include __DIR__ . "/../../components/alerts.php"; ?>

      <header class="c-hero">
        <h1 class="c-title">Crear Local</h1>
      </header>

      <form action="<?php echo app_path('src/controller/local/handle_create_local.php'); ?>" method="POST" class="c-form-layout">

        <div class="c-form-field">
          <input
            type="text"
            class="c-form-input"
            id="nombre_local"
            name="nombre_local"
            placeholder=" "
            required>
          <label class="c-form-label" for="nombre_local">Nombre del Local</label>
        </div>

        <div class="c-form-field">
          <input
            type="text"
            class="c-form-input"
            id="ubicacion_local"
            name="ubicacion_local"
            placeholder=" "
            required>
          <label class="c-form-label" for="ubicacion_local">Ubicación del Local</label>
        </div>

        <div class="c-form-field">
          <input
            type="text"
            class="c-form-input"
            id="rubro_local"
            name="rubro_local"
            placeholder=" "
            required>
          <label class="c-form-label" for="rubro_local">Rubro del Local</label>
        </div>

        <div class="c-form-field">
          <select
            class="c-form-input c-form-input-select"
            id="dueno_local"
            name="dueno_local"
            required>
            <option value="">Seleccionar un dueño</option>
            <?php foreach ($duenos as $d) {
              if ($d->estadoDueno === EstadoDueno::ACEPTADO->value && $d->estadoMail === EstadoMail::CONFIRMADO->value) {
                echo ("
              <option value='" . htmlspecialchars($d->idUsuario, ENT_QUOTES, 'UTF-8') . "'>
                " . htmlspecialchars($d->nombreUsuario, ENT_QUOTES, 'UTF-8') . "
              </option>"
                );
              }
            } ?>
          </select>
          <label class="c-form-label" for="dueno_local">Dueño del Local</label>
        </div>

        <button type="submit" class="c-btn-primary" id="botonCrear" name="botonCrear">Crear Local</button>

        <div>
          <a href="<?php echo app_path('src/view/pages/local/local_list.php'); ?>" class="c-btn-secondary-ghost ">Volver a la Lista de Locales</a>
        </div>
      </form>
    </section>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>