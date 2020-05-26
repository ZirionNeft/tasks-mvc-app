<?php

namespace App\Core;

class Router
{

  /**
   * *controller_name* / *controller_action* ? *params*
   *
   * @return array
   */
  public function resolve(): array
  {
    $uri = $_SERVER['REQUEST_URI'];
    if(($getRequestStartsFrom = strpos($uri, '?')) !== false){
      $route = substr($uri, 0, $getRequestStartsFrom);
      parse_str(substr($uri, $getRequestStartsFrom+1, strlen($uri)), $params);
    }

    $route = $route ?? $_SERVER['REQUEST_URI'];
    $route = explode('/', $route);

    array_shift($route);

    $result[0] = array_shift($route);
    $result[1] = array_shift($route);
    $result[2] = $params ?? null;

    return $result;
  }

  private static function getRoute($route)
  {
    $uri = $_SERVER['REQUEST_URI'];
    if(($getRequestStartsFrom = strpos($uri, '?')) !== false){
      $route = substr($uri, 0, $getRequestStartsFrom);
    }
    return $route ?? $_SERVER['REQUEST_URI'];
  }

  public static function currentRoute()
  {

  }

}