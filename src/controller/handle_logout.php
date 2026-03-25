<?php

require "Auth.php";

$auth = new Auth();
$auth->endSession();
header("Location: /index.php");
