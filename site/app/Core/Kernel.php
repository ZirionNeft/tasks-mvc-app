<?php


namespace App\Core;


use App;
use App\Exceptions\InvalidRouteException;

class Kernel
{
  private static $defaultControllerName = 'Home';

  private static $defaultActionName = "index";

  /**
   * @throws InvalidRouteException
   * @throws \ReflectionException
   */
  public function launch(): void
  {
    list($controllerName, $actionName, $params) = App::getRouter()->resolve();
    echo $this->execute($controllerName, $actionName, $params);
  }

  /**
   * @param $controllerName
   * @param $actionName
   * @param $params
   * @return mixed
   * @throws InvalidRouteException | \ReflectionException
   */
  public function execute($controllerName, $actionName, $params)
  {

    $controllerName = empty($controllerName) ? self::$defaultControllerName : ucfirst($controllerName);

    $reflector = new \ReflectionClass('App\\Controllers\\' . $controllerName . 'Controller');

    $actionName = empty($actionName) ? self::$defaultActionName : $actionName;

    if (!$reflector->hasMethod($actionName)) {
      throw new InvalidRouteException();
    }

    return $reflector
      ->getMethod($actionName)
      ->invokeArgs($reflector->newInstance(), $params);
  }
}