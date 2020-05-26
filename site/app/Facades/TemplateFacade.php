<?php

namespace App\Facades;

use App;

class TemplateFacade
{
  public static function render(string $view, array $data = [], array $mergeData = []): string
  {
    $blade = App::getBlade();
    return $blade->render($view, $data, $mergeData);
  }

  public static function getTemplateEngine()
  {
    return App::getBlade();
  }
}