<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Más sobre nosotros</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../styles/styles.css" />
</head>

<body>
  <header>
    <?php include_once __DIR__ . '/../components/header.php' ?>
  </header>
  <main>
    <div class="container my-5 c-menu-container">

      <!-- Texto de bienvenida -->
      <div class="row mb-5 text-center justify-content-center">
        <div class="col-lg-8 col-12">
          <div class="c-menu-welcome">
            <h2 class="c-menu-title">BIENVENIDOS A RIVENDELL PLAZA</h2>
            <p class="c-menu-subtitle">Ubicado en el corazón de Rosario, es mucho más que un destino de compras; es un punto de encuentro donde la modernidad se cruza con la calidez de nuestra ciudad.</p>
          </div>
        </div>
      </div>

      <!-- Sección: Nuestra Propuesta -->
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-10 col-12">
          <div class="c-menu-card">
            <h3 class="c-menu-card-title text-center mb-4">NUESTRA PROPUESTA</h3>
            <p class="c-menu-card-text text-center mb-4">Desde nuestra apertura, nos hemos propuesto ser el referente en tendencias y servicios de la región, brindando un espacio seguro, cómodo y dinámico para todas las edades.</p>

            <div class="row g-4">
              <div class="col-lg-6 col-12">
                <div class="d-flex align-items-start">
                  <i class="bi bi-handbag c-menu-icon-orange-sm me-3"></i>
                  <div>
                    <h5>Moda y Tendencias</h5>
                    <p class="c-menu-card-text mb-0">Una selección exclusiva de marcas nacionales e internacionales que definen la temporada.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="d-flex align-items-start">
                  <i class="bi bi-cup-hot c-menu-icon-orange-sm me-3"></i>
                  <div>
                    <h5>Gastronomía</h5>
                    <p class="c-menu-card-text mb-0">Un patio de comidas diverso con opciones que van desde café de especialidad hasta cenas gourmet.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="d-flex align-items-start">
                  <i class="bi bi-controller c-menu-icon-orange-sm me-3"></i>
                  <div>
                    <h5>Entretenimiento</h5>
                    <p class="c-menu-card-text mb-0">Espacios pensados para el disfrute familiar, incluyendo zonas interactivas y eventos culturales periódicos.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="d-flex align-items-start">
                  <i class="bi bi-check-circle c-menu-icon-orange-sm me-3"></i>
                  <div>
                    <h5>Servicios</h5>
                    <p class="c-menu-card-text mb-0">Facilidades diseñadas para tu comodidad, con amplios estacionamientos y atención personalizada.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sección: Misión y Visión -->
      <div class="row mb-5 justify-content-center g-4">
        <div class="col-lg-5 col-12">
          <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
            <i class="bi bi-bullseye c-menu-icon-orange-lg"></i>
            <h3 class="c-menu-card-title text-center mt-3">MISIÓN</h3>
            <p class="c-menu-card-text text-center">Brindar a los rosarinos y visitantes un ambiente excepcional donde las compras, el ocio y la innovación se encuentran en un solo lugar.</p>
          </div>
        </div>
        <div class="col-lg-5 col-12">
          <div class="c-menu-card d-flex flex-column justify-content-center align-items-center h-100">
            <i class="bi bi-eye c-menu-icon-orange-lg"></i>
            <h3 class="c-menu-card-title text-center mt-3">VISIÓN</h3>
            <p class="c-menu-card-text text-center">Consolidarnos como el shopping líder de Rosario, impulsando el crecimiento local y adaptándonos constantemente a las nuevas formas de consumo y tecnología.</p>
          </div>
        </div>
      </div>

      <!-- Sección: Compromiso Local -->
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-10 col-12">
          <div class="c-menu-card d-flex flex-column justify-content-center align-items-center">
            <i class="bi bi-heart c-menu-icon-orange-lg"></i>
            <h3 class="c-menu-card-title text-center mt-3 mb-4">COMPROMISO LOCAL</h3>
            <p class="c-menu-card-text text-center mb-0">En Rivendell Plaza, nos enorgullece formar parte del tejido social de Rosario. Trabajamos activamente con emprendedores locales y promovemos iniciativas que potencian el talento y el desarrollo de nuestra comunidad.</p>
          </div>
        </div>
      </div>

      <!-- Sección: CTA Final -->
      <div class="row justify-content-center">
        <div class="col-lg-8 col-12">
          <div class="c-menu-card text-center">
            <h3 class="c-menu-card-title mb-3">¡TE ESPERAMOS!</h3>
            <p class="c-menu-card-text mb-4">Descubrí todo lo que tenemos para vos en Rivendell Plaza.</p>
          </div>
        </div>
      </div>

    </div>
  </main>
  <footer>
    <?php include_once __DIR__ . '/../components/footer.php' ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>