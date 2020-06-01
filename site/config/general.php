<?php

return [
  'views' => APP_DIR . DS . 'views',

  'admin' => [
    'login'     => 'admin',
    'password'  => '$2y$10$THb.Gn1/CuUTBEmNJqEiOu/ml32U5W6KLrHY5IgeUYS3G7MLKy2t2' // hashed "123"
  ],

  'database' => [
    'host'      => 'postgres',
    'port'      => '5432',
    'dbname'    => 'app',
    'user'      => 'app',
    'password'  => getenv('DB_PASSWORD'),
  ]
];