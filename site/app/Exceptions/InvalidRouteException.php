<?php

namespace App\Exceptions;

use Exception;

class InvalidRouteException extends Exception
{
  public function __construct($message = "", $code = 0, \Throwable $previous = null) {
    return parent::__construct("Route not found", $code, $previous);
  }
}