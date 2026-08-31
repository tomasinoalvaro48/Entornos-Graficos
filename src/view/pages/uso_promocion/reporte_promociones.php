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

// --- KPIs ---
$totalUsos = count($usos);
$usosAceptados = 0;
$usosRechazados = 0;
$usosEnviados = 0;
foreach ($usos as $u) {
  $estado = strtolower((string)$u->estado);
  if ($estado === 'aceptada') $usosAceptados++;
  elseif ($estado === 'rechazada') $usosRechazados++;
  elseif ($estado === 'enviada') $usosEnviados++;
}
$tasaConversion = $totalUsos > 0 ? round(($usosAceptados / $totalUsos) * 100, 1) : 0;

// --- Datos gráfico por local ---
$usosPorLocal = [];
foreach ($promociones as $p) {
  $nombreLocal = $p->local->nombreLocal;
  $cantUsos = count($usosPorPromo[$p->idPromo] ?? []);
  $usosPorLocal[$nombreLocal] = ($usosPorLocal[$nombreLocal] ?? 0) + $cantUsos;
}
arsort($usosPorLocal);
$localesLabels = array_keys($usosPorLocal);
$localesData = array_values($usosPorLocal);

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <section class="col-lg-9 col-12">
      <!-- TARJETAS DE RESUMEN (KPIs) -->
      <div class="row my-3 px-3">
        <!-- KPI 1 -->
        <div class="col-md-4 mb-3 mb-md-0 px-2">
          <div class="c-menu-card h-100 d-flex flex-column justify-content-center align-items-center text-center p-4">
            <span class="c-list-cart-body-label">Total de Usos Registrados</span>
            <span class="c-kpi-value c-kpi-value--accent mt-2"><?php echo $totalUsos; ?></span>
            <span class="c-kpi-subtitle">En todas las promociones</span>
          </div>
        </div>

        <!-- KPI 2 -->
        <div class="col-md-4 mb-3 mb-md-0 px-2">
          <div class="c-menu-card h-100 d-flex flex-column justify-content-center align-items-center text-center p-4">
            <span class="c-list-cart-body-label w-100 mb-3">Balance de Estados</span>
            <div class="d-flex justify-content-between w-100 px-3">
              <div>
                <div class="c-kpi-estado-value c-kpi-estado-value--success"><?php echo $usosAceptados; ?></div>
                <div class="c-kpi-estado-label">Aceptados</div>
              </div>
              <div>
                <div class="c-kpi-estado-value c-kpi-estado-value--warning"><?php echo $usosEnviados; ?></div>
                <div class="c-kpi-estado-label">Enviados</div>
              </div>
              <div>
                <div class="c-kpi-estado-value c-kpi-estado-value--danger"><?php echo $usosRechazados; ?></div>
                <div class="c-kpi-estado-label">Rechazados</div>
              </div>
            </div>
          </div>
        </div>

        <!-- KPI 3 -->
        <div class="col-md-4 px-2">
          <div class="c-menu-card h-100 d-flex flex-column justify-content-center align-items-center text-center p-4">
            <span class="c-list-cart-body-label">Efectividad (Conversión)</span>
            <span class="c-kpi-value c-kpi-value--success mt-2"><?php echo $tasaConversion; ?>%</span>
            <span class="c-kpi-subtitle">Tasa de aceptación global</span>
          </div>
        </div>
      </div>

      <!-- GRÁFICO DE BARRAS POR LOCAL -->
      <?php if (!empty($localesLabels)) { ?>
      <div class="row mb-4 px-3">
        <div class="col-12 px-2">
          <div class="c-menu-card p-4">
            <span class="c-list-cart-body-label mb-3">Rendimiento por Local (Cantidad de usos)</span>
            <div class="c-chart-wrapper">
              <canvas id="graficoLocales"></canvas>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

      <div class="row c-list">
        <h2 class="c-section-title mb-3 ps-0">Detalle de Promociones</h2>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const canvas = document.getElementById('graficoLocales');
      if (!canvas) return;

      Chart.defaults.color = '#a8add0';
      Chart.defaults.font.family = "'Raleway', sans-serif";

      const ctx = canvas.getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($localesLabels); ?>,
          datasets: [{
            label: 'Total de Usos',
            data: <?php echo json_encode($localesData); ?>,
            backgroundColor: 'rgba(249, 177, 122, 0.8)',
            borderColor: '#ffa866',
            borderWidth: 1,
            borderRadius: 6,
            hoverBackgroundColor: '#ffa866'
          }]
        },
        options: {
          indexAxis: 'y',
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#1b1f3a',
              titleColor: '#f9b17a',
              bodyColor: '#fff',
              borderColor: 'rgba(249, 177, 122, 0.4)',
              borderWidth: 1,
              padding: 10
            }
          },
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                precision: 0
              },
              grid: {
                color: 'rgba(252, 163, 100, 0.1)',
                drawBorder: false
              }
            },
            y: {
              grid: {
                display: false,
                drawBorder: false
              },
              ticks: {
                font: { weight: 'bold' }
              }
            }
          }
        }
      });
    });
  </script>
</body>

</html>