<?php

return [
  'views' => APP_DIR . DS . 'views',

  'admin' => [
    'login'     => 'admin',
    'password'  => '$2y$10$THb.Gn1/CuUTBEmNJqEiOu/ml32U5W6KLrHY5IgeUYS3G7MLKy2t2' // hashed "123"
  ],

  'database' => [
    'host'      => getenv('DB_HOST'),
    'port'      => getenv('DB_PORT'),
    'dbname'    => getenv('DB_NAME'),
    'user'      => getenv('DB_USER'),
    'password'  => getenv('DB_PASSWORD'),
  ]
];