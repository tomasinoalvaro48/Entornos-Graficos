<?php
require_once __DIR__ . "/../../../controller/dueno/show_duenos.php";

$duenos = handleDuenosList();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validar Cuentas de Dueños</title>
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
    <div class="col-lg-4 col-12">
      <aside class="c-aside">
        <div class="row c-hero">
          <h1 class="c-title">Cuentas de Dueños</h1>
          <p class="c-subtitle">Revisá y administrá las cuentas para cada dueño.</p>
        </div>

        <div class="row">
          <form action="" method="POST" class="c-form-layout">
            <div class="row">
              <div class="col-lg-12 col-md-4 col-12 my-1">
                <div class="c-form-field">
                  <input
                    type="text"
                    class="c-form-input"
                    id="nombre_dueno"
                    name="nombre_dueno"
                    placeholder=" "
                    value="<?php echo isset($_POST['nombre_dueno']) ? htmlspecialchars($_POST['nombre_dueno'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                  <label class="c-form-label" for="nombre_dueno">Nombre</label>
                </div>
              </div>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <div class="c-form-field">
                  <select class="c-form-input c-form-input-select" id="estado_dueno" name="estado_dueno">
                    <option value="">Cualquier estado</option>
                    <option value="<?php echo EstadoDueno::PENDIENTE->value; ?>" <?php echo (isset($_POST['estado_dueno']) && $_POST['estado_dueno'] === EstadoDueno::PENDIENTE->value) ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="<?php echo EstadoDueno::ACEPTADO->value; ?>" <?php echo (isset($_POST['estado_dueno']) && $_POST['estado_dueno'] === EstadoDueno::ACEPTADO->value) ? 'selected' : ''; ?>>Aceptado</option>
                    <option value="<?php echo EstadoDueno::RECHAZADO->value; ?>" <?php echo (isset($_POST['estado_dueno']) && $_POST['estado_dueno'] === EstadoDueno::RECHAZADO->value) ? 'selected' : ''; ?>>Rechazado</option>
                  </select>
                  <label class="c-form-label" for="estado_dueno">Estado</label>
                </div>
              </div>

              <div class="col-lg-12 col-md-4 col-12 my-1">
                <button type="submit" class="c-btn-primary" id="botonFiltrarDuenos" name="botonFiltrarDuenos">Filtrar</button>
              </div>

              <div class="col-lg-12 col-md-4 col-12 my-1 mt-lg-0">
                <a class="c-btn-secondary-ghost" href="<?php echo app_path(); ?>">
                  Volver al menú
                </a>
              </div>
            </div>
          </form>
        </div>
      </aside>
    </div>

    <section class="col-lg-8 col-12">
      <?php include __DIR__ . '/../../components/alerts.php'; ?>

      <div class="c-table-container">
        <table class="c-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($duenos)) { ?>
              <tr>
                <td colspan="5" class="text-center">No hay cuentas de Dueños registradas.</td>
              </tr>
            <?php } else { ?>
              <?php foreach ($duenos as $dueno) {
                $estadoDueno = strtolower((string)$dueno->estadoDueno);
                $estadoBadgeClass = 'text-bg-secondary';
                if ($estadoDueno === EstadoDueno::PENDIENTE->value) {
                  $estadoBadgeClass = 'text-bg-warning';
                } else if ($estadoDueno === EstadoDueno::ACEPTADO->value) {
                  $estadoBadgeClass = 'text-bg-success';
                } else if ($estadoDueno === EstadoDueno::RECHAZADO->value) {
                  $estadoBadgeClass = 'text-bg-danger';
                }
              ?>
                <tr>
                  <td><?php echo htmlspecialchars($dueno->idUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($dueno->nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($dueno->emailUsuario, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td>
                    <span class="badge <?php echo $estadoBadgeClass; ?>">
                      <?php echo strtoupper(htmlspecialchars($dueno->estadoDueno, ENT_QUOTES, 'UTF-8')); ?>
                    </span>
                  </td>
                  <td>
                    <div class="row">

                      <?php if ($dueno->estadoDueno === EstadoDueno::PENDIENTE->value) { ?>
                        <div class="col-6">
                          <a class="c-btn-primary c-table-btn-sm col-6" href="<?php echo app_path('src/controller/dueno/handle_validar_cuenta.php'); ?>?estado=aceptado&id=<?php echo $dueno->idUsuario; ?>">
                            Aceptar
                          </a>
                        </div>
                        <div class="col-6">
                          <a class="c-btn-danger-tonal c-table-btn-sm col-6" href="<?php echo app_path('src/controller/dueno/handle_validar_cuenta.php'); ?>?estado=rechazado&id=<?php echo $dueno->idUsuario; ?>">
                            Rechazar
                          </a>
                        </div>

                      <?php } else { ?>
                        <div class="col 12">
                          <div class="c-text-muted">Cuenta gestionada</div>
                        </div>
                      <?php } ?>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>