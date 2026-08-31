<?php
require_once __DIR__ . "/../../controller/auth.php";
require_once __DIR__ . "/../../controller/novedad/show_novedad.php";
require_once __DIR__ . "/../../controller/dueno/show_duenos.php";
require_once __DIR__ . "/../../enums.php";

function renderHeaderNotifications()
{
  $tipo = getTipoUsuario();

  $items = [];
  $unseenCount = 0;
  $footerLink = null;
  $footerLabel = null;
  $markSeen = isset($_GET['notificaciones']) && $_GET['notificaciones'] === 'seen';

  // Solo se muestran notificaciones para clientes, dueños y admins
  // Administradores ven cuentas de dueños pendientes, clientes y dueños ven novedades

  if ($tipo === TipoUsuario::ADMIN->value) {
    $pendingDuenos = showDuenosFiltered(null, EstadoDueno::PENDIENTE->value);
    $pendingCount = count($pendingDuenos);

    // Si el admin accede a la página de notificaciones, se marca que ha visto las pendientes actuales
    if ($markSeen) {
      $_SESSION['pending_duenos_seen'] = $pendingCount;
    }

    // Se calcula cuántas notificaciones pendientes no ha visto el admin
    $seenCount = (int)($_SESSION['pending_duenos_seen'] ?? 0);
    $unseenCount = max(0, $pendingCount - $seenCount);

    // El enlace del footer lleva a la lista de dueños pendientes, marcando que se han visto
    $footerLink = app_path('src/view/pages/usuario/validar_cuentas_dueno.php?estado=pendiente&notificaciones=seen');
    $footerLabel = 'Ver dueños pendientes';

    // Solo se muestran las 5 primeras notificaciones para no saturar el dropdown -> cambiar si queremos aumentar/disminuir
    $pendingDuenos = array_slice($pendingDuenos, 0, 5);
    foreach ($pendingDuenos as $dueno) {
      $items[] = [
        'title' => $dueno->nombreUsuario,
        'text' => 'Cuenta pendiente de aprobación.',
        'meta' => $dueno->emailUsuario
      ];
    }
  }

  // Para clientes y dueños se muestran novedades, filtrando por categoría del cliente en caso de ser cliente
  if ($tipo === TipoUsuario::CLIENTE->value || $tipo === TipoUsuario::DUENO->value) {
    $categoriaCliente = $tipo === TipoUsuario::CLIENTE->value ? getCategoriaCliente() : null;
    $novedades = showNovedadesByCategoriaCliente($categoriaCliente);

    // Si el usuario accede a la página de notificaciones, se marca que ha visto las novedades actuales
    if ($markSeen) {
      $_SESSION['novedades_seen_date'] = date('Y-m-d');
    }

    // Se calcula cuántas novedades nuevas no ha visto el usuario comparando la fecha de las 
    // novedades con la última fecha que se marcaron como vistas
    $lastSeenRaw = $_SESSION['novedades_seen_date'] ?? null;
    $lastSeenDate = $lastSeenRaw ? new DateTime($lastSeenRaw) : null;
    $newNovedades = [];

    // Se consideran nuevas las novedades que tengan fechaDesdeNovedad posterior a la última fecha vista
    foreach ($novedades as $novedad) {
      if (!$lastSeenDate) {
        $newNovedades[] = $novedad;
      }
    }

    $unseenCount = count($newNovedades);
    $footerLink = app_path('src/view/pages/novedad/novedad_list.php?notificaciones=seen');
    $footerLabel = 'Ver novedades';

    // Solo se muestran las 5 primeras novedades para no saturar el dropdown -> cambiar si queremos aumentar/disminuir
    $newNovedades = array_slice($newNovedades, 0, 5);
    foreach ($newNovedades as $novedad) {
      $fecha = $novedad->fechaDesdeNovedad ? $novedad->fechaDesdeNovedad->format('d-m-Y') : 'Sin fecha';
      $items[] = [
        'title' => 'Nueva novedad',
        'text' => $novedad->textoNovedad,
        'meta' => $fecha
      ];
    }
  }
?>

  <li class="nav-item dropdown c-header-notifications">
    <a class="nav-link dropdown-toggle c-header-notifications-toggle" href="#" id="cHeaderNotifications" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notificaciones">
      <span class="c-header-notifications-icon">
        <i class="bi bi-bell"></i>
        <?php if ($unseenCount > 0) { ?>
          <span class="c-header-notifications-badge"><?php echo $unseenCount; ?></span>
        <?php } ?>
      </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end c-header-notifications-menu" aria-labelledby="cHeaderNotifications">
      <div class="c-header-notifications-head">
        <span>Notificaciones</span>
        <?php if ($unseenCount > 0) { ?>
          <span class="c-header-notifications-count"><?php echo $unseenCount; ?> nuevas</span>
        <?php } ?>
      </div>
      <div class="c-header-notifications-list">
        <?php if (empty($items)) { ?>
          <div class="c-header-notifications-empty">No tenes notificaciones nuevas.</div>
        <?php } else { ?>
          <?php foreach ($items as $item) { ?>
            <div class="c-header-notifications-item">
              <div class="c-header-notifications-item-title"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></div>
              <div class="c-header-notifications-item-text"><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></div>
              <?php if (!empty($item['meta'])) { ?>
                <div class="c-header-notifications-item-meta"><?php echo htmlspecialchars($item['meta'], ENT_QUOTES, 'UTF-8'); ?></div>
              <?php } ?>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
      <?php if ($footerLink && $footerLabel) { ?>
        <div class="c-header-notifications-footer">
          <a class="c-header-notifications-link" href="<?php echo $footerLink; ?>"><?php echo $footerLabel; ?></a>
        </div>
      <?php } ?>
    </div>
  </li>
<?php
}
