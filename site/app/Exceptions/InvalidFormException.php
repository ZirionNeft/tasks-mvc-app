<?php


namespace App\Exceptions;


use Exception;

class InvalidFormException extends Exception
{
  public function __construct($message = "Form Error", $code = 0, \Throwable $previous = null) {
    return parent::__construct("Form Error: ${message}", $code, $previous);
  }
}