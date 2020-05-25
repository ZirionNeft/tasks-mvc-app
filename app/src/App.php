<?php


use Core\Database;
use Core\Router;

class App
{
  private static $router;
  private static $database;

  public static function run(): void
  {
    self::$router = new Router();
    self::$database = new Database();
  }

}