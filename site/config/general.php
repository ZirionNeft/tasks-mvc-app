<?php

return [
  'views' => APP_DIR . DS . 'views',

  'database' => [
    'host'      => 'postgres',
    'port'      => '5432',
    'dbname'    => 'app',
    'user'      => 'app',
    'password'  => getenv('DB_PASSWORD'),
  ]
];