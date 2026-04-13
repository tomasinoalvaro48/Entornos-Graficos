<?php
require_once __DIR__ . "/../../../controller/promocion/show_promocion.php";

$promociones = showPromociones();
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
      crossorigin="anonymous"
    />
  </head>
  
  <body>
    <header>
      <?php include __DIR__ . '/../../components/header.php' ?>
    </header>
    
    <main class="container">
      <div class="row">
        <div class="col">
          <h1 class="text-center">Promociones</h1>
        </div>
      </div>
      
      <?php include __DIR__ . '/../../components/alerts.php'; ?>
      
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Texto</th>
                  <th>Local</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>
              
              <tbody>
                <?php if (empty($promociones)) { ?>
                  <tr>
                    <td colspan="5" class="text-center">No hay promociones nuevas.</td>
                  </tr>
                <?php } else { ?>
                  <?php foreach ($promociones as $promo) {
                    $estadoPromo = strtolower((string)$promo->estadoPromo);
                    $estadoBadgeClass = 'text-bg-secondary';
                  
                    if ($estadoPromo === 'pendiente') {
                      $estadoBadgeClass = 'text-bg-warning';
                    }
                    else if ($estadoPromo === 'aprobada') {
                      $estadoBadgeClass = 'text-bg-success';
                    }
                    else if ($estadoPromo === 'denegada') {
                      $estadoBadgeClass = 'text-bg-danger';
                    }
                  
                    $modalId = 'modal-validar-promo-' . (int)$promo->idPromo;
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($promo->idPromo, ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo htmlspecialchars($promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?></td>
                  
                      <td>
                        <span class="badge <?php echo $estadoBadgeClass; ?>">
                          <?php echo strtoupper(htmlspecialchars($promo->estadoPromo, ENT_QUOTES, 'UTF-8')); ?>
                        </span>
                      </td>
                  
                      <td>
                        <?php if ($promo->estadoPromo === 'pendiente') { ?>
                          <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>"
                          >
                            Gestionar promo
                          </button>
                    
                          <div class="modal fade" id="<?php echo htmlspecialchars($modalId, ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Validar promoción</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                          
                                <div class="modal-body">
                                  <p class="mb-3">¿Qué desea hacer con esta promo?</p>

                                  <ul class="list-group">
                                    <li class="list-group-item">
                                      <strong>Texto:</strong>
                                      <?php echo htmlspecialchars($promo->textoPromo, ENT_QUOTES, 'UTF-8'); ?>
                                    </li>

                                    <li class="list-group-item">
                                      <strong>Vigencia:</strong>
                                      <?php echo $promo->fechaDesdePromo->format('d/m/Y'); ?>
                                      -
                                      <?php echo $promo->fechaHastaPromo->format('d/m/Y'); ?>
                                    </li>

                                    <li class="list-group-item">
                                      <strong>Categoría cliente:</strong>
                                      <?php echo htmlspecialchars($promo->categoriaClientePromo, ENT_QUOTES, 'UTF-8'); ?>
                                    </li>

                                    <li class="list-group-item">
                                      <strong>Días:</strong>
                                      <?php
                                        $dias = [];
                                        $diasTexto = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

                                        foreach ($promo->diasSemanaPromo as $d) {
                                          $dias[] = $diasTexto[$d] ?? $d;
                                        }

                                        echo implode(", ", $dias);
                                      ?>
                                    </li>

                                    <li class="list-group-item">
                                      <strong>Local:</strong>
                                      <?php echo htmlspecialchars($promo->local->nombreLocal, ENT_QUOTES, 'UTF-8'); ?>
                                    </li>
                                  </ul>
                                </div>
                          
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            
                                  <a class="btn btn-danger"
                                    href="/src/controller/dueno/handle_validar_promocion.php?estado=denegada&id=<?php echo $promo->idPromo; ?>"
                                  >
                                    Denegar
                                  </a>
                            
                                  <a class="btn btn-success"
                                    href="/src/controller/dueno/handle_validar_promocion.php?estado=aprobada&id=<?php echo $promo->idPromo; ?>"
                                  >
                                    Aprobar
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } else { ?>
                          <span class="text-muted">Promo gestionada</span>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row mt-4">
        <div class="col text-center">
          <a href="/" class="btn btn-secondary">Volver al menú</a>
        </div>
      </div>
    </main>
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous">
    </script>
  </body>
</html>