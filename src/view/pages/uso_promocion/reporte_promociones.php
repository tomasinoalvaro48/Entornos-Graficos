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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="row c-page-main">
    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="c-hero">
          <h1 class="c-title">Reporte de uso de promociones</h1>
        </div>

        <form method="GET" class="c-form-layout">
          <div class="c-form-field">
            <input type="text" name="busqueda" class="c-form-input" placeholder=" "
              value="<?php echo htmlspecialchars($busqueda); ?>">
            <label class="c-form-label">Buscar promo o local</label>
          </div>

          <div class="c-form-field">
            <select name="dia" class="c-form-input c-form-input-select">
              <option value="">Todos los días</option>
              <?php
              $diasSelect = [1 => "Lunes", 2 => "Martes", 3 => "Miércoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sábado", 7 => "Domingo"];
              foreach ($diasSelect as $num => $nombre) {
                $selected = ($diaFiltro == $num) ? 'selected' : '';
                echo "<option value='$num' $selected>$nombre</option>";
              }
              ?>
            </select>
            <label class="c-form-label">Día</label>
          </div>

          <div class="c-form-field">
            <select name="local" class="c-form-input c-form-input-select">
              <option value="">Todos los locales</option>
              <?php
              $locales = [];
              foreach ($promociones as $p) {
                $locales[$p->local->idLocal] = $p->local->nombreLocal;
              }
              foreach ($locales as $id => $nombre) {
                $selected = ($localFiltro == $id) ? 'selected' : '';
                echo "<option value='$id' $selected>$nombre</option>";
              }
              ?>
            </select>
            <label class="c-form-label">Local</label>
          </div>

          <button type="submit" class="c-btn-primary">
            Filtrar
          </button>

          <a class="c-btn-secondary-tonal"
            href="<?php echo app_path('src/view/pages/uso_promocion/reporte_promociones.php'); ?>">
            Limpiar filtros
          </a>

          <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
            Volver al menú
          </a>
        </form>
      </aside>
    </div>

    <section class="col-lg-7 col-12">
      <div class="row c-list">
        <?php if (empty($promociones)) { ?>
          <div class="alert alert-info text-center mt-5">
            No hay promociones.
          </div>
        <?php } ?>

        <?php foreach ($promociones as $p) {
          if ($busqueda) {
            $texto = strtolower($p->textoPromo);
            $localNombre = strtolower($p->local->nombreLocal);

            if (!str_contains($texto, strtolower($busqueda)) && !str_contains($localNombre, strtolower($busqueda))) {
              continue;
            }
          }

          if ($diaFiltro && !in_array($diaFiltro, $p->diasSemanaPromo->getArrayCopy())) {
            continue;
          }

          if ($localFiltro && $p->local->idLocal != $localFiltro) {
            continue;
          }

          $diasTexto = [1 => "Lun", 2 => "Mar", 3 => "Mié", 4 => "Jue", 5 => "Vie", 6 => "Sáb", 7 => "Dom"];
          $dias = [];
          foreach ($p->diasSemanaPromo as $d) {
            $dias[] = $diasTexto[$d] ?? $d;
          }
        ?>



          <article class="col-12 accordion" id="accordionPromo<?php echo $p->idPromo; ?>">
            <div class="accordion-item c-accordion-item">
              <h2 class="accordion-header c-accordion-header">
                <button class="accordion-button collapsed c-accordion-button" type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapsePromo<?php echo $p->idPromo; ?>"
                  aria-expanded="false"
                  aria-controls="collapsePromo<?php echo $p->idPromo; ?>">
                  <div class="col-6">
                    <h5 class="c-list-card-title">
                      <?php
                      $texto = $p->textoPromo;
                      echo htmlspecialchars(mb_strlen($texto, 'UTF-8') > 35 ? mb_substr($texto, 0, 35, 'UTF-8') . '...' : $texto);
                      ?>
                    </h5>
                  </div>
                  <div class="col-2 text-center">
                    <span class="c-list-cart-body-date">
                      <?php echo htmlspecialchars($p->local->nombreLocal); ?>
                    </span>
                  </div>
                  <div class="col-2">
                    <span class="c-list-card-category">
                      <?php echo strtoupper($p->estadoPromo); ?>
                    </span>
                  </div>
                  <div class="col-2 text-center">
                    <span class="c-list-cart-body-date">
                      <?php if (!empty($usosPorPromo[$p->idPromo]))
                        echo htmlspecialchars("Usos: " . count($usosPorPromo[$p->idPromo]));
                      else
                        echo htmlspecialchars("No hay usos"); ?>
                    </span>
                  </div>
                </button>
              </h2>
              <div id="collapsePromo<?php echo $p->idPromo; ?>" class="accordion-collapse collapse">
                <div class="accordion-body c-accordion-body">
                  <div class="c-list-cart-body-container">
                    <div class="row mb-4">
                      <div class="col-6">
                        <label class="c-list-cart-body-label">FECHA DESDE</label>
                        <span class="c-list-cart-body-date">
                          <?php echo $p->fechaDesdePromo->format('d-m-Y'); ?>
                        </span>
                      </div>
                      <div class="col-6 text-end">
                        <label class="c-list-cart-body-label">FECHA HASTA</label>
                        <span class="c-list-cart-body-date">
                          <?php echo $p->fechaHastaPromo->format('d-m-Y'); ?>
                        </span>
                      </div>
                    </div>

                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">DESCRIPCIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($p->textoPromo); ?>
                      </p>
                    </div>

                    <div class="c-list-cart-body-desc-container mt-2">
                      <label class="c-list-cart-body-label">DETALLE</label>
                      <p class="c-list-cart-body-desc-text">
                        Local: <?php echo htmlspecialchars($p->local->nombreLocal); ?><br>
                        Días: <?php echo implode(", ", $dias); ?><br>
                        Categoría: <?php echo htmlspecialchars($p->categoriaClientePromo); ?>
                      </p>
                    </div>

                    <div class="mt-3">
                      <label class="c-list-cart-body-label">USOS</label>

                      <?php if (!empty($usosPorPromo[$p->idPromo])) { ?>
                        <div class="c-table-container">
                          <table class="c-table">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($usosPorPromo[$p->idPromo] as $u) {
                                $estadoUso = strtolower((string)$u->estado);
                                $estadoBadgeClass = 'text-bg-secondary';
                                if ($estadoUso === 'enviada') {
                                  $estadoBadgeClass = 'text-bg-warning';
                                } elseif ($estadoUso === 'aceptada') {
                                  $estadoBadgeClass = 'text-bg-success';
                                } elseif ($estadoUso === 'rechazada') {
                                  $estadoBadgeClass = 'text-bg-danger';
                                }
                              ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($u->nombreCliente); ?></td>
                                  <td><?php echo $u->fechaUso->format('d-m-Y'); ?></td>
                                  <td>
                                    <span class="badge <?php echo $estadoBadgeClass; ?>">
                                      <?php echo strtoupper(htmlspecialchars($u->estado)); ?>
                                    </span>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      <?php } else { ?>
                        <p class="c-text-muted">No hay usos.</p>
                      <?php } ?>
                    </div>

                  </div>

                </div>
              </div>
            </div>
          </article>
        <?php } ?>
      </div>
    </section>
  </main>

  <footer>
    <?php include_once __DIR__ . '/../../components/footer.php' ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>