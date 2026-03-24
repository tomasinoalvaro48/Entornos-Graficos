<?php

session_start();
session_destroy();
header("Location: /TP-Entornos-Graficos/index.php");
exit();
