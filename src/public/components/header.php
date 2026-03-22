<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">LOGO</a>
    <div>
      Bienvenido <?php echo $_SESSION["tipo_usuario"] ?? 'No hay tipo'; ?>
    </div>


    <!-- USUARIO NO LOGUEADO -->
    <?php
    if (
      !isset($_SESSION["tipo_usuario"])
      && $_SERVER["REQUEST_URI"] !== "/src/public/pages/login.php"
      && $_SERVER["REQUEST_URI"] !== "/src/public/pages/signin.php"
    ) {
    ?>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar Locales o Promociones" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/promociones-list">Promociones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/public/pages/locales_list.php">Locales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/public/pages/login.php">Iniciar sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/src/public/pages/signin.php">Registrarse</a>
          </li>
        </ul>
      </div>


      <!-- ADMIN -->
      <?php
    } else if (isset($_SESSION["tipo_usuario"])) {
      if ($_SESSION["tipo_usuario"] === "admin") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/src/public/pages/index.php">Inicio ADMIN</a>
            </li>
          </ul>
        </div>


        <!-- CLIENTE -->
      <?php
      } else if ($_SESSION["tipo_usuario"] === "cliente") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/src/public/pages/index.php">Inicio CLIENTE</a>
            </li>
          </ul>
        </div>


        <!-- DUEÑO DE LOCAL -->
      <?php
      } else if ($_SESSION["tipo_usuario"] === "dueno") {
      ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/src/public/pages/index.php">Inicio DUEÑO</a>
            </li>
          </ul>
        </div>
      <?php
      }
      ?>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/src/config/handle_logout.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    <?php
    }
    ?>
  </div>
</nav>