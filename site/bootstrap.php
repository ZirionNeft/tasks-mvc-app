<?php

define('DS', DIRECTORY_SEPARATOR);
define("CONFIG_PATH", realpath('config'));
define('ROOT_DIR', realpath('..'));
define('APP_DIR', realpath(''));
define('CACHE_DIR', realpath('cache'));

require __DIR__ . '/vendor/autoload.php';

if (!isset($_ENV['DEV_MODE']) || $_ENV['DEV_MODE'] !== 'production') {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}

require_once __DIR__ . "/app/App.php";