<?php

define('DS', DIRECTORY_SEPARATOR);
define('CONFIG_PATH', realpath('..' . DS . 'config'));
define('ROOT_DIR', realpath('..'));

$loader = new \Core\Autoload();

$loader->register();