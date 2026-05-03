<?php
require_once __DIR__ . "/../../controller/get_locales_promociones.php";

// Arreglo de locales
$locales = getLocalesPromociones();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultados de busqueda</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <?php include __DIR__ . '/../components/header.php' ?>
  </header>

  <main class="row c-page-main">
    <div class="col-12">
      <section class="row">
        <div class="col-12">
          <aside class="c-aside">
            <div class="row c-hero">
              <h1 class="c-title">Resultados de busqueda</h1>
              <p class="c-subtitle">
                Escribí en la barra de busqueda para ver locales y promociones.
              </p>
            </div>
          </aside>
        </div>
      </section>

      <?php if (!$locales) { ?>
        <div class="alert alert-info mt-4 text-center" role="alert">
          <p>No se encontraron locales o promociones.</p>
        </div>
      <?php } else { ?>
        <div class="row">
          <section class="col-lg-4 col-12">
            <div class="row c-list">
              <div class="col-12">
                <h2>Locales</h2>
              </div>

              <?php foreach ($locales as $l) { ?>
                <article class="col-12 c-list-card">
                  <div class="row c-list-card-header">
                    <div class="col-12 c-list-card-title">
                      <h5><?php echo htmlspecialchars($l->nombreLocal, ENT_QUOTES, 'UTF-8'); ?></h5>
                    </div>
                  </div>

                  <div class="c-list-cart-body-container">
                    <div class="c-list-cart-body-desc-container">
                      <label class="c-list-cart-body-label">RUBRO</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($l->rubroLocal, ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </div>

                    <div class="c-list-cart-body-desc-container mt-3">
                      <label class="c-list-cart-body-label">UBICACION</label>
                      <p class="c-list-cart-body-desc-text">
                        <?php echo htmlspecialchars($l->ubiLocal, ENT_QUOTES, 'UTF-8'); ?>
                      </p>
                    </div>
                  </div>
                </article>
              <?php } ?>
            </div>
          </section>

          <section class="col-lg-8 col-12">
            <div class="row c-list">
              <div class="col-12">
                <h2>Promociones</h2>
              </div>

            </div>
          <?php } ?>
        </div>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>