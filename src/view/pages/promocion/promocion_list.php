<?php
require_once __DIR__ . "/../../../controller/promocion/show_promocion.php";
require_once __DIR__ . "/../../../controller/local/show_local.php";
require_once __DIR__ . "/../../../controller/auth.php";
require_once __DIR__ . "/../../../data/UsoPromocionDAO.php";
require_once __DIR__ . "/../../../enums.php";

$tipo = getTipoUsuario();

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();

$promociones = handlePromocionesList();
$locales = showLocales();
$usoDAO = new UsoPromocionDAO();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promociones</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../../components/header.php' ?>
  </header>

  <main class="row c-page-main">
    <div class="col-lg-3 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Promociones</h1>
          <p class="c-subtitle">
            <?php
            if ($tipo === TipoUsuario::DUENO->value) {
              echo "Visualizá y gestioná tus promociones.";
            } else {
              echo "Visualizá todas las promociones disponibles.";
            }
            ?>
          </p>
        </div>

        <div class="row">
          <form action="" method="POST" class="c-form-layout">
            <div class="row">
              <div class="col-lg-12 col-4 my-1">
                <div class="c-form-field">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    id="fecha_desde_promocion"
                    name="fecha_desde_promocion"
                    placeholder=" ">
                  <label class="c-form-label" for="fecha_desde_promocion">Fecha desde</label>
                </div>
              </div>

              <div class="col-lg-12 col-4 my-1">
                <div class="c-form-field">
                  <input
                    type="date"
                    class="c-form-input c-form-input-date"
                    id="fecha_hasta_promocion"
                    name="fecha_hasta_promocion"
                    placeholder=" ">
                  <label class="c-form-label" for="fecha_hasta_promocion">Fecha hasta</label>
                </div>
              </div>
              
              <?php if ($tipo !== TipoUsuario::CLIENTE->value) { ?>
                <div class="col-lg-12 col-4 my-1">
                  <div class="c-form-field">
                    <select
                      class="c-form-input c-form-input-select"
                      id="categoria_cliente"
                      name="categoria_cliente">
                      <option value="">Seleccione una categoría</option>
                      <option value="inicial">Inicial</option>
                      <option value="medium">Medium</option>
                      <option value="premium">Premium</option>
                    </select>
                    <label class="c-form-label" for="categoria_cliente">Categoría de cliente</label>
                  </div>
                </div>
              <?php } ?>

              <?php if ($tipo === TipoUsuario::DUENO->value) { ?>
                <div class="col-lg-12 col-4 my-1">
                  <div class="c-form-field">
                    <select
                      class="c-form-input c-form-input-select"
                      name="estado_promocion">
                      <option value="">Seleccione estado</option>
                      <option value="pendiente">Pendiente</option>
                      <option value="aprobada">Aprobada</option>
                      <option value="denegada">Denegada</option>
                    </select>
                    <label class="c-form-label">Estado</label>
                  </div>
                </div>
              <?php } ?>

              <div class="col-lg-12 col-4 my-1">
                <div class="c-form-field">
                  <select
                    class="c-form-input c-form-input-select"
                    name="local">
                    <option value="">Seleccione un local</option>
                    <?php foreach ($locales as $l) { ?>
                      <option value="<?php echo $l->idLocal; ?>">
                        <?php echo htmlspecialchars($l->nombreLocal); ?>
                      </option>
                    <?php } ?>
                  </select>
                  <label class="c-form-label">Local</label>
                </div>
              </div>

              <div class="col-lg-12 col-4 my-1">
                <div class="c-form-field">
                  <select
                    class="c-form-input c-form-input-select"
                    name="dia">
                    <option value="">Seleccione un día</option>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sábado</option>
                    <option value="7">Domingo</option>
                  </select>
                  <label class="c-form-label">Día</label>
                </div>
              </div>

              <div class="col-lg-12 col-4 my-1">
                <button type="submit"
                  class="c-btn-primary"
                  name="botonFiltrarPromociones">
                  Filtrar
                </button>
              </div>
            </div>
          </form>

          <?php if ($tipo === TipoUsuario::DUENO->value) { ?>
            <div class="col-lg-12 col-6">
              <a class="c-btn-secondary-tonal" href="<?php echo app_path('src/view/pages/promocion/create_promocion.php'); ?>">
                Crear Promoción
              </a>
            </div>
          <?php } ?>

          <div class="col-lg-12 col-6">
            <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
              Volver al menú
            </a>
          </div>
        </div>
      </aside>
    </div>

    <?php if (empty($promociones)) { ?>
      <section class="col-8">
        <div class="alert alert-info mt-5 text-center" role="alert">
          <p>No hay promociones registradas.</p>
        </div>
      </section>
    <?php } else { ?>
      <section class="col-lg-7 col-12">
        <?php include __DIR__ . "/../../components/alerts.php" ?>

        <div class="row c-list">
          <?php foreach ($promociones as $p) {
            $diasTexto = [
              1 => "Lun",
              2 => "Mar",
              3 => "Mié",
              4 => "Jue",
              5 => "Vie",
              6 => "Sáb",
              7 => "Dom"
            ];

            $dias = [];
            foreach ($p->diasSemanaPromo as $d) {
              $dias[] = $diasTexto[$d] ?? $d;
            }
          ?>
            <article class="col-12 c-list-card">
              <div class="row c-list-card-header">
                <div class="col-lg-6 c-list-card-title">
                  <h5>Promoción #<?php echo htmlspecialchars($p->idPromo, ENT_QUOTES, 'UTF-8'); ?></h5>
                </div>

                <div class="col-lg-6 c-list-card-category">
                  <span>Categoría de cliente: <?php echo htmlspecialchars(ucfirst($p->categoriaClientePromo), ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
              </div>

              <div class="c-list-cart-body-container">
                <div class="row mb-4">
                  <div class="col-6">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA DESDE</label>
                      <span class="c-list-cart-body-date">
                        <?php echo $p->fechaDesdePromo->format('Y-m-d'); ?>
                      </span>
                    </div>
                  </div>

                  <div class="col-6 text-end">
                    <div class="c-list-cart-body-info-group">
                      <label class="c-list-cart-body-label">FECHA HASTA</label>
                      <span class="c-list-cart-body-date">
                        <?php echo $p->fechaHastaPromo->format('Y-m-d'); ?>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">DESCRIPCIÓN</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($p->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">DETALLE</label>
                      <p class="c-list-cart-body-desc-text">
                        Días que aplica: <?php echo implode(", ", $dias); ?> <br>
                        Local: <?php echo htmlspecialchars($p->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </div>
                  </div>
                </div>

                <?php if ($tipo === TipoUsuario::DUENO->value) { ?>
                  <div class="mt-3">
                    <label class="c-list-cart-body-label">ESTADO</label>
                    <span class="c-list-card-category">
                      <?php echo strtoupper(htmlspecialchars($p->estadoPromo, ENT_QUOTES, 'UTF-8')); ?>
                    </span>
                  </div>
                <?php } ?>

                <?php if ($tipo === TipoUsuario::DUENO->value && $p->estadoPromo === "aprobada") {
                  $cantidadUsos = $usoDAO->countUsosAceptadosByPromo($p->idPromo);
                ?>
                  <div class="mt-3">
                    <label class="c-list-cart-body-label">USOS</label>
                    <span class="c-list-cart-body-date">
                      <?php echo $cantidadUsos; ?> clientes la usaron
                    </span>
                  </div>
                <?php } ?>
              </div>

              <?php if ($tipo === TipoUsuario::DUENO->value) { ?>
                <div class="row">
                  <div class="col-lg-12">
                    <a class="c-btn-danger-tonal"
                      href="<?php echo app_path('src/controller/promocion/handle_delete_promocion.php'); ?>?id=<?php echo htmlspecialchars($p->idPromo, ENT_QUOTES, 'UTF-8'); ?>">
                      Eliminar
                    </a>
                  </div>
                </div>
              <?php } ?>

              <?php if ($tipo === TipoUsuario::CLIENTE->value) { ?>
                <form
                  method="POST"
                  action="<?php echo app_path('src/controller/uso_promocion/handle_usar_promocion.php'); ?>">
                  
                  <input
                    type="hidden"
                    name="id_promo"
                    value="<?php echo htmlspecialchars($p->idPromo, ENT_QUOTES, 'UTF-8'); ?>">

                  <button type="submit" class="c-btn-primary mt-2">
                    Usar promoción
                  </button>
                </form>
              <?php } ?>
            </article>
          <?php } ?>
        </div>
      </section>
    <?php } ?>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>