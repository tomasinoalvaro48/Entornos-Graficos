<?php

require_once __DIR__ . '/../../vendor/autoload.php';

if (!defined('APP_ENV_LOADED')) {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
  $dotenv->safeLoad();
  define('APP_ENV_LOADED', true);
}
