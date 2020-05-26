<?php


use App\Core\Config;
use App\Core\Database;
use App\Core\Kernel;
use App\Core\Router;
use App\Exceptions\InvalidRouteException;
use Jenssegers\Blade\Blade;

class App
{
  private static $router;
  private static $database;
  private static $kernel;
  private static $blade;

  public static function run(): void
  {
    try {
      self::$router = new Router();
      self::$database = new Database();
      self::$kernel = new Kernel();

      self::$blade = new Blade(
        Config::getConfig('general', 'views'),
        CACHE_DIR
      );

      self::$kernel->launch();

    } catch (InvalidRouteException $e) {
      echo $e;
    } catch (Exception $e) {
      echo $e;
    }
  }

  /**
   * @return mixed
   */
  public static function getRouter(): Router
  {
    return self::$router;
  }

  /**
   * @return mixed
   */
  public static function getDatabase(): Database
  {
    return self::$database;
  }

  /**
   * @return mixed
   */
  public static function getBlade(): Blade
  {
    return self::$blade;
  }


}