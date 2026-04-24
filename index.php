<?php

require_once __DIR__ . '/src/config/env.php';

function getMainPage()
{
  require_once __DIR__ . "/src/controller/auth.php";
  $tipo = getTipoUsuario();
  $page = 'src/view/pages/menu_publico.php'; // usuarios no autenticados
  if ($tipo) {
    if ($tipo === 'cliente') {
      $page = 'src/view/pages/menu_cliente.php';
    } else if ($tipo === 'admin') {
      $page = 'src/view/pages/menu_admin.php';
    } else if ($tipo === 'dueno') {
      $page = 'src/view/pages/menu_dueno.php';
    }
  }
  return $page;
}
?>


<!doctype html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menú</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="src/view/styles/styles.css" />
</head>

<body>
  <header>
    <?php
    include "src/view/components/header.php";
    ?>
  </header>

  <section>
    <?php
    include getMainPage();
    ?>
  </section>

  <footer>
    <?php
    include "src/view/components/footer.php"
    ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
  </script>
</body>

</html>