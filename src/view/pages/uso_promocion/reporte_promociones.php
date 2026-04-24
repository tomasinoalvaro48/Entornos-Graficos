<?php
require_once __DIR__ . "/../../../controller/promocion/show_promocion.php";
require_once __DIR__ . "/../../../controller/auth.php";
require_once __DIR__ . "/../../../data/UsoPromocionDAO.php";

$tipo = getTipoUsuario();

$promociones = showPromociones();

$usoDAO = new UsoPromocionDAO();
$usos = $usoDAO->getAllWithCliente();

$usosPorPromo = [];
foreach ($usos as $u) {
  $usosPorPromo[$u->idPromo][] = $u;
}

$busqueda = $_GET['busqueda'] ?? '';
$diaFiltro = $_GET['dia'] ?? '';
$localFiltro = $_GET['local'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Reporte de uso de promociones</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main>
    <div class="container mt-4">
      <div class="row">
        <div class="col">
          <h1>Reporte de uso de promociones</h1>
        </div>
      </div>

      <form method="GET" class="row mt-3 mb-4">
        <div class="col-md-4">
          <input 
            type="text" 
            name="busqueda" 
            class="form-control"
            placeholder="Buscar promoción o local"
            value="<?php echo $_GET['busqueda'] ?? ''; ?>"
          >
        </div>

        <div class="col-md-3">
          <select name="dia" class="form-select">
            <option value="">Filtrar por día</option>
            <?php
            $diasSelect = [
              1 => "Lunes",
              2 => "Martes",
              3 => "Miércoles",
              4 => "Jueves",
              5 => "Viernes",
              6 => "Sábado",
              7 => "Domingo"
            ];
            foreach ($diasSelect as $num => $nombre) {
              $selected = (isset($_GET['dia']) && $_GET['dia'] == $num) ? 'selected' : '';
              echo "<option value='$num' $selected>$nombre</option>";
            }
            ?>
          </select>
        </div>

        <div class="col-md-3">
          <select name="local" class="form-select">
            <option value="">Filtrar por local</option>
            <?php
            $locales = [];
            foreach ($promociones as $p) {
              $locales[$p->local->idLocal] = $p->local->nombreLocal;
            }
            foreach ($locales as $id => $nombre) {
              $selected = (isset($_GET['local']) && $_GET['local'] == $id) ? 'selected' : '';
              echo "<option value='$id' $selected>$nombre</option>";
            }
            ?>
          </select>
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
      </form>

      <?php if (empty($promociones)) { ?>
        <p class="text-center mt-4">No hay promociones.</p>
      <?php } ?>

      <?php foreach ($promociones as $p) {
        if (!empty($busqueda)) {
          $texto = strtolower($p->textoPromo);
          $localNombre = strtolower($p->local->nombreLocal);
          $busquedaLower = strtolower($busqueda);

          if (!str_contains($texto, $busquedaLower) && !str_contains($localNombre, $busquedaLower)) {
            continue;
          }
        }

        if (!empty($diaFiltro)) {
          if (!in_array($diaFiltro, $p->diasSemanaPromo->getArrayCopy())) {
            continue;
          }
        }

        if (!empty($localFiltro)) {
          if ($p->local->idLocal != $localFiltro) {
            continue;
          }
        }
      ?>
        <div class="card mt-4 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo htmlspecialchars($p->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
            </h5>

            <p>
              <b>Local:</b>
              <?php echo htmlspecialchars($p->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <p>
              <b>Vigencia:</b>
              <?php echo $p->fechaDesdePromo->format('d/m/Y'); ?>
              -
              <?php echo $p->fechaHastaPromo->format('d/m/Y'); ?>
            </p>

            <p>
              <b>Días de la semana:</b>
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

            <p>
              <b>Categoría cliente:</b>
              <?php echo htmlspecialchars($p->categoriaClientePromo, ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <p>
              <b>Estado:</b>
              <?php echo htmlspecialchars($p->estadoPromo, ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <hr>

            <h6>Usos de la promoción:</h6>

            <?php if (!empty($usosPorPromo[$p->idPromo])) { ?>
              <?php foreach ($usosPorPromo[$p->idPromo] as $u) { ?>
                <div class="border rounded p-2 mb-2">
                  <p class="mb-1">
                    <b>Cliente:</b>
                    <?php echo htmlspecialchars($u->nombreCliente, ENT_QUOTES, 'UTF-8'); ?>
                  </p>

                  <p class="mb-1">
                    <b>Fecha uso:</b>
                    <?php echo $u->fechaUso->format('d/m/Y'); ?>
                  </p>

                  <p class="mb-0">
                    <b>Estado:</b>
                    <?php echo htmlspecialchars($u->estado, ENT_QUOTES, 'UTF-8'); ?>
                  </p>
                </div>
              <?php } ?>
            <?php } else { ?>
              <p>No hay usos para esta promoción.</p>
            <?php } ?>
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