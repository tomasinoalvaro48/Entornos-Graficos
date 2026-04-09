<?php
require_once __DIR__ . "/../../controller/auth.php";

$error = getSessionError();
$success = getSessionSuccess();
clearSessionMessages();
?>

<!-- Mostrar mensaje de error si existe -->
<?php if ($error) { ?>
  <div class="row mb-3">
    <div class="col">
      <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Mostrar mensaje de éxito si existe -->
<?php if ($success) { ?>
  <div class="row mb-3">
    <div class="col">
      <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    </div>
  </div>
<?php } ?>