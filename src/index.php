<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="stylesheet" href="styles/styles.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />

    <?php 
    include "config/db_functions.php";
    createDataBase();
    ?>

  </head>
  <body>
    <nav>
      <?php include "templates/components/header.html"; ?>
    </nav>

    <section>
      <?php include "templates/Menu.html"; ?>
    </section>

    <footer>
      <?php include "templates/components/footer.html" ?>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
