<?php

require_once __DIR__ . "/../controller/auth.php";

endSession();
header("Location: " . app_path("index.php"));