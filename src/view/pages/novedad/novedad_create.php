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
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <h1>Crear Novedad</h1>
      </div>
    </div>
    <div class="row">
      <?php include __DIR__ . "/../../components/alerts.php"; ?>

      <form action="/src/controller/novedad/handle_create_novedad.php" method="POST">
        <div>
          <label for="texto_novedad">Descripción de la Novedad</label>
          <input type="text" class="form-control" id="texto_novedad" name="texto_novedad" required>
        </div>
        <div>
          <label for="texto_novedad">Fecha Desde</label>
          <input type="date" class="form-control" id="fecha_desde_novedad" name="fecha_desde_novedad" required>
        </div>
        <div>
          <label for="texto_novedad">Fecha Hasta</label>
          <input type="date" class="form-control" id="fecha_hasta_novedad" name="fecha_hasta_novedad" required>
        </div>
        <div>
          <label for="texto_novedad">Descripción de la Novedad</label>
          <select class='form-control' id='tipo_usuario' name="tipo_usuario" required>
            <option value="">Seleccione un Tipo de Usuario
            </option>
            <option value="administrador">Administrador
            </option>
            <option value="dueno">Dueño de local
            </option>
            <option value="cliente">Cliente
            </option>

          </select>
        </div>
        <button type="submit" class='btn btn-primary' id='botonCrearNovedad' name="botonCrearNovedad">Crear Novedad</button>
        <a href="/src/view/pages/novedad/novedad_list.php" class="btn btn-secondary">Volver a la Lista de Novedades</a>


      </form>


    </div>


  </div>

</body>

</html>