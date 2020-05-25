<?php

namespace Core;

class Router
{
  public function resolve(): array
  {
    if(($getRequestStartsFrom = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
      $route = substr($_SERVER['REQUEST_URI'], 0, $getRequestStartsFrom);
    }

    $route = $route ?? $_SERVER['REQUEST_URI'];
    $route = explode('/', $route);

    array_shift($route);

    $result[0] = array_shift($route);
    $result[1] = array_shift($route);
    $result[2] = $route;

    return $result;
  }

}