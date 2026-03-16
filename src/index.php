<!doctype html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="styles/styles.css" />

  <?php
  include "config/db_functions.php";
  //createDataBase();                 AGREGAR CREACIÓN DE LA BASE DE DATOS
  ?>

</head>

<body>
  <header>
    <?php include "components/header.php"; ?>
  </header>

  <section>
    <?php 
    include "config/auth.php";
    include authPages($_GET['page']) // lógica para obtener la página solicitada y autorizar segun el rol del usuario
    ?>
  </section>

  <footer class="fixed-bottom">
    <?php include "components/footer.php" ?>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>