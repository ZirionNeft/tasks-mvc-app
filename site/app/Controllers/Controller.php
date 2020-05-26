<?php

namespace App\Controllers;

use App\Facades\TemplateFacade;

class Controller
{

  public function render ($viewName, array $params = [])
  {
    return TemplateFacade::render($viewName, $params);
  }
}