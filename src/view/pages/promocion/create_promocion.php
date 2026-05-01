<?php
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/auth.php";

$error = getSessionError();
clearSessionMessages();

$locales = showLocales();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Crear Promoción</title>

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

  <main class="c-page-main align-items-center">
    <section class="c-card">
      <?php include __DIR__ . "/../../components/alerts.php"; ?>

      <header class="c-hero">
        <h1 class="c-title">Crear Promoción</h1>
      </header>

      <form action="<?php echo app_path('src/controller/promocion/handle_create_promocion.php'); ?>" method="POST" class="c-form-layout">
        <div class="c-form-field">
          <input
            type="text"
            class="c-form-input"
            id="texto_promo"
            name="texto_promo"
            placeholder=" "
            maxlength="200"
            required>
          <label class="c-form-label" for="texto_promo">Texto promoción</label>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="c-form-field">
              <input
                type="date"
                class="c-form-input c-form-input-date"
                id="fecha_desde"
                name="fecha_desde"
                placeholder=" "
                required>
              <label class="c-form-label" for="fecha_desde">Fecha desde</label>
            </div>
          </div>

          <div class="col-6">
            <div class="c-form-field">
              <input
                type="date"
                class="c-form-input c-form-input-date"
                id="fecha_hasta"
                name="fecha_hasta"
                placeholder=" "
                required>
              <label class="c-form-label" for="fecha_hasta">Fecha hasta</label>
            </div>
          </div>
        </div>

        <div class="c-form-field">
          <select
            class="c-form-input c-form-input-select"
            id="categoria_cliente"
            name="categoria_cliente"
            required>
            <option value="">Seleccione una categoría</option>
            <option value="inicial">Inicial</option>
            <option value="medium">Medium</option>
            <option value="premium">Premium</option>
          </select>
          <label class="c-form-label" for="categoria_cliente">Categoría de cliente</label>
        </div>

        <div>
          <label class="c-list-cart-body-label">Días de la semana</label>
          <div class="mt-2">
            <?php
            $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            foreach ($dias as $i => $dia) {
              echo "
                <label class='c-form-check'>
                  <input class='c-form-check-input' type='checkbox' name='dias_semana[]' value='" . ($i + 1) . "'>
                  $dia
                </label>
              ";
            }
            ?>
          </div>
        </div>

        <div class="c-form-field">
          <select
            class="c-form-input c-form-input-select"
            id="id_local"
            name="id_local"
            required>
            <option value="">Seleccionar local</option>
            <?php foreach ($locales as $l) {
              echo "<option value='{$l->idLocal}'>{$l->nombreLocal}</option>";
            } ?>
          </select>
          <label class="c-form-label" for="id_local">Local</label>
        </div>

        <button type="submit" class="c-btn-primary" id="botonCrear" name="botonCrear">
          Crear Promoción
        </button>

        <div>
          <a href="<?php echo app_path('src/view/pages/promocion/promocion_list.php'); ?>" class="c-btn-secondary-ghost">
            Volver a Promociones
          </a>
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