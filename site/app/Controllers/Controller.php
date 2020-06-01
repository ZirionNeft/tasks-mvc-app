<?php

namespace App\Controllers;

use App\Facades\TemplateFacade;

class Controller
{

  protected $currentRoute = '/';

  public function render ($viewName, array $params = [])
  {
    return TemplateFacade::render($viewName, array_merge($params, [
      'currentRoute' => $this->currentRoute
    ]));
  }
}