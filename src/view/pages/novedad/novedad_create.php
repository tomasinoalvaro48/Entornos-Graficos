<?php
$today = new DateTime();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Novedad</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>

  <header>
    <?php include_once __DIR__ . '/../../components/header.php' ?>
  </header>
  <main class="c-page-main align-items-center">
    <section class="c-card" aria-label="Crear Novedad">
      <?php include __DIR__ . "/../../components/alerts.php"; ?>

      <header class="c-hero">
        <h1 class="c-title">Crear Novedad</h1>
      </header>

      <form action="<?php echo app_path('src/controller/novedad/handle_create_novedad.php'); ?>" method="POST" class="c-form-layout">
        <div class="c-form-field">
          <input
            type="text"
            class="c-form-input"
            id="texto_novedad"
            name="texto_novedad"
            placeholder=" "
            required
            maxlength="255">
          <label class="c-form-label" for="texto_novedad">Descripción de la Novedad</label>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="c-form-field">
              <input
                type="date"
                class="c-form-input c-form-input-date"
                min="<?php echo $today->format('Y-m-d'); ?>"
                id="fecha_desde_novedad"
                name="fecha_desde_novedad"
                placeholder=" "
                required>
              <label class="c-form-label" for="fecha_desde_novedad">Fecha Desde</label>
            </div>
          </div>
          <div class="col-6">
            <div class=" c-form-field ">
              <input
                type="date"
                class="c-form-input c-form-input-date"
                min="<?php echo $today->format('Y-m-d'); ?>"
                id="fecha_hasta_novedad"
                name="fecha_hasta_novedad"
                placeholder=" "
                required>
              <label class="c-form-label" for="fecha_hasta_novedad">Fecha Hasta</label>
            </div>
          </div>

        </div>

        <div class="c-form-field">
          <select
            class="c-form-input c-form-input-select"
            id="categoria_cliente"
            name="categoria_cliente"
            required>
            <option value="">Seleccione una Categoría</option>
            <option value="inicial">Inicial</option>
            <option value="medium">Medium</option>
            <option value="premium">Premium</option>
          </select>
          <label class="c-form-label" for="categoria_cliente">Categoría de Cliente</label>
        </div>

        <button type="submit" class="c-btn-primary" id="botonCrearNovedad" name="botonCrearNovedad">Crear Novedad</button>

        <div>
          <a href="<?php echo app_path('src/view/pages/novedad/novedad_list.php'); ?>" class="c-btn-secondary-ghost ">Volver a la Lista de Novedades</a>
        </div>
      </form>
    </section>
  </main>

</body>

<script>
  <?php include_once __DIR__ . "/fecha_validator.js"; ?>
</script>

</html>