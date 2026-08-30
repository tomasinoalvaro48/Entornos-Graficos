<?php
require_once __DIR__ . "/../../../controller/promocion/show_promocion.php";
require_once __DIR__ . '/../../../controller/auth.php';
require_once __DIR__ . '/../../../enums.php';

/*filtro*/
$tipo = getTipoUsuario();
$promociones = handlePromocionesValidacionList();

// ----- Paginacion -----
$promosPerPage = 6;
$totalPromos = count($promociones);
$totalPages = (int) ceil($totalPromos / $promosPerPage);
$currentPage = 1;

if (isset($_POST['page']) && $totalPages > 0) {
  $currentPage = (int) $_POST['page'];
  $currentPage = max(1, min($currentPage, $totalPages));
}

$startIndex = ($currentPage - 1) * $promosPerPage;
$promosPage = $totalPromos > 0 ? array_slice($promociones, $startIndex, $promosPerPage) : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Validar Promociones</title>

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

  <main class="row c-page-main">
    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Promociones</h1>
          <p class="c-subtitle">Revisá y administrá las promociones publicadas.</p>
        </div>

        <div class="row">
          <form action="" method="POST" class="c-form-layout">
            <div class="row">
              <div class="col-lg-12 col-md-6 col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="text"
                    class="c-form-input"
                    id="nombre_local"
                    name="nombre_local"
                    placeholder=" "
                    value="<?php echo isset($_POST['nombre_local']) ? htmlspecialchars($_POST['nombre_local'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="nombre_local">Local</label>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-12 my-1">
                <div class="c-form-field">
                  <select
                    class="c-form-input c-form-input-select"
                    id="estado_promocion"
                    name="estado_promocion">
                    <option value="">Todos los Estados</option>
                    <option value="pendiente" <?php echo (isset($_POST['estado_promocion']) && $_POST['estado_promocion'] === 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="aprobada" <?php echo (isset($_POST['estado_promocion']) && $_POST['estado_promocion'] === 'aprobada') ? 'selected' : ''; ?>>Aprobada</option>
                    <option value="denegada" <?php echo (isset($_POST['estado_promocion']) && $_POST['estado_promocion'] === 'denegada') ? 'selected' : ''; ?>>Denegada</option>
                  </select>
                  <label class="c-form-label" for="estado_promocion">Estado</label>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-12 my-1">
                <button type="submit" class="c-btn-primary" id="botonFiltrarPromociones" name="botonFiltrarPromociones">Filtrar</button>
              </div>

              <div class="col-lg-12 col-md-6 col-12 my-1">
                <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/promocion/validar_promociones.php'); ?>">
                  Limpiar filtros
                </a>
              </div>
            </div>
          </form>

          <div class="col-12 my-1 mt-lg-3">
            <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
              Volver al menú
            </a>
          </div>
        </div>
      </aside>
    </div>

    <?php if ($totalPromos === 0) { ?>
      <section class="col-8">
        <?php include __DIR__ . '/../../components/alerts.php'; ?>
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No hay promociones registradas.</p>
        </div>
      </section>
    <?php } else { ?>
      <section class="col-lg-7 col-12">
        <?php include __DIR__ . '/../../components/alerts.php'; ?>
        <div class="row c-list">
          <?php foreach ($promosPage as $promo) {
            $estadoPromo = strtolower((string)$promo->estadoPromo);
          ?>
            <article class="col-12 accordion" id="accordionPromo<?php echo $promo->idPromo; ?>">
              <div class="accordion-item c-accordion-item">
                <h2 class="accordion-header c-accordion-header">
                  <button class="accordion-button collapsed c-accordion-button" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePromo<?php echo $promo->idPromo; ?>"
                    aria-expanded="false"
                    aria-controls="collapsePromo<?php echo $promo->idPromo; ?>">
                    <div class="col-6">
                      <h5 class="c-list-card-title">
                        <?php
                        $texto = $promo->textoPromo;
                        echo htmlspecialchars(mb_strlen($texto, 'UTF-8') > 35 ? mb_substr($texto, 0, 35, 'UTF-8') . '...' : $texto);
                        ?>
                      </h5>
                    </div>
                    <div class="col-3 text-center">
                      <span class="c-list-cart-body-date">
                        <?php echo htmlspecialchars($promo->local->nombreLocal); ?>
                      </span>
                    </div>
                    <div class="col-3">
                      <span class="c-list-card-category">
                        <?php echo strtoupper(htmlspecialchars($promo->estadoPromo, ENT_QUOTES, 'UTF-8')); ?>
                      </span>
                    </div>
                  </button>
                </h2>
                <div id="collapsePromo<?php echo $promo->idPromo; ?>" class="accordion-collapse collapse">
                  <div class="accordion-body c-accordion-body">
                    <div class="c-list-cart-body-container">
                      <div class="row mb-4">
                        <div class="col-6">
                          <div class="c-list-cart-body-info-group">
                            <label class="c-list-cart-body-label">FECHA DESDE</label>
                            <span class="c-list-cart-body-date">
                              <?php echo $promo->fechaDesdePromo ? $promo->fechaDesdePromo->format('Y-m-d') : 'N/A'; ?>
                            </span>
                          </div>
                        </div>

                        <div class="col-6 text-end">
                          <div class="c-list-cart-body-info-group">
                            <label class="c-list-cart-body-label">FECHA HASTA</label>
                            <span class="c-list-cart-body-date">
                              <?php echo $promo->fechaHastaPromo ? $promo->fechaHastaPromo->format('Y-m-d') : 'N/A'; ?>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="c-list-cart-body-desc-container">
                            <label class="c-list-cart-body-label">DESCRIPCIÓN</label>
                            <p class="c-list-cart-body-desc-text">
                              <?php echo htmlspecialchars($promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="c-list-cart-body-desc-container">
                            <label class="c-list-cart-body-label">DETALLE</label>
                            <p class="c-list-cart-body-desc-text">
                              <?php
                                $dias = [];
                                $diasTexto = [1=>"Lun",2=>"Mar",3=>"Mié",4=>"Jue",5=>"Vie",6=>"Sáb",7=>"Dom"];
                                foreach ($promo->diasSemanaPromo as $d) {
                                  $dias[] = $diasTexto[$d] ?? $d;
                                }
                              ?>
                              Días que aplica: <?php echo implode(", ", $dias); ?> <br>
                              Local: <?php echo htmlspecialchars($promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?> <br>
                              Categoría de cliente: <?php echo htmlspecialchars(ucfirst($promo->categoriaClientePromo), ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <?php if ($estadoPromo === 'pendiente') { ?>
                        <div class="col-md-6 col-12">
                          <a class="c-btn-danger-tonal"
                            href="<?php echo app_path('src/controller/promocion/handle_validar_promocion.php'); ?>?estado=denegada&id=<?php echo $promo->idPromo; ?>">
                            Denegar
                          </a>
                        </div>
                        <div class="col-md-6 col-12">
                          <a class="c-btn-secondary-tonal"
                            href="<?php echo app_path('src/controller/promocion/handle_validar_promocion.php'); ?>?estado=aprobada&id=<?php echo $promo->idPromo; ?>">
                            Aprobar
                          </a>
                        </div>
                      <?php } else { ?>
                        <div class="col-12 text-center c-list-cart-body-label mt-2">
                          Promo gestionada
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          <?php } ?>
        </div>

        <?php if ($totalPages > 1) { ?>
          <nav aria-label="Navegación de páginas">
            <form method="POST" class="d-flex justify-content-center mt-3">
              <?php if (isset($_POST['botonFiltrarPromociones'])) { ?>
                <input type="hidden" name="botonFiltrarPromociones" value="1">
              <?php } ?>
              <?php if (isset($_POST['nombre_local'])) { ?>
                <input type="hidden" name="nombre_local" value="<?php echo htmlspecialchars($_POST['nombre_local'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php } ?>
              <?php if (isset($_POST['estado_promocion'])) { ?>
                <input type="hidden" name="estado_promocion" value="<?php echo htmlspecialchars($_POST['estado_promocion'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php } ?>
              <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                  <?php if ($currentPage <= 1) { ?>
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                  <?php } else { ?>
                    <button type="submit" class="page-link" name="page" value="<?php echo $currentPage - 1; ?>">
                      <span aria-hidden="true">&laquo;</span>
                    </button>
                  <?php } ?>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                  <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                    <button type="submit" class="page-link" name="page" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                  </li>
                <?php } ?>
                <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                  <?php if ($currentPage >= $totalPages) { ?>
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                  <?php } else { ?>
                    <button type="submit" class="page-link" name="page" value="<?php echo $currentPage + 1; ?>">
                      <span aria-hidden="true">&raquo;</span>
                    </button>
                  <?php } ?>
                </li>
              </ul>
            </form>
          </nav>
        <?php } ?>
      </section>
    <?php } ?>
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