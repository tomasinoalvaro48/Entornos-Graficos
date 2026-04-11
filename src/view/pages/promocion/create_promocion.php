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
      href="../styles/styles.css"
    />
  </head>
    
  <body>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <h1>Crear Promoción</h1>
        </div>
      </div>
        
      <div class="row">
        <div class="col">
          <?php if ($error) { ?>
          <div class="row mt-3">
            <div class="col">
              <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
              </div>
            </div>
          </div>
          <?php } ?>
          
          <form action="/src/controller/promocion/handle_create_promocion.php" method="POST">
            <div>
              <label for="texto_promo" class="form-label">Texto promoción</label>
              <input type="text" class="form-control" id="texto_promo" name="texto_promo" maxlength="200" required>
            </div>
              
            <div>
              <label for="fecha_desde" class="form-label">Fecha desde</label>
              <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" required>
            </div>

            <div>
              <label for="fecha_hasta" class="form-label">Fecha hasta</label>
              <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" required>
            </div>

            <div>
              <label for="categoria_cliente" class="form-label">Categoría de cliente</label>
              <select class="form-control" id="categoria_cliente" name="categoria_cliente" required>
                <option value="Inicial">Inicial</option>
                <option value="Medium">Medium</option>
                <option value="Premium">Premium</option>
              </select>
            </div>
              
            <div>
              <label class="form-label">Días de la semana</label><br>
              <?php
              $dias = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
              foreach ($dias as $i => $dia) {
                echo "
                <input type='checkbox' id='dia_$i' name='dias_semana[]' value='" . ($i+1) . "'>
                <label for='dia_$i'>$dia</label>
                ";
              }
              ?>
            </div>

            <div>
              <label for="id_local" class="form-label">Local</label>
              <select class="form-control" id="id_local" name="id_local" required>
                <option value="">Seleccionar local</option>
                <?php foreach ($locales as $l) {
                  echo "<option value='{$l->idLocal}'>{$l->nombreLocal}</option>";
                } ?>
              </select>
            </div>
             
            <button type="submit" class="btn btn-primary" id="botonCrear" name="botonCrear">
              Crear Promoción
            </button>
          </form>
            
          <a href="/src/view/pages/menu_dueno.php" class="btn btn-secondary">
            Volver al menú
          </a>
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