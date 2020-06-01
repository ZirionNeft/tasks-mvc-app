<?php

namespace App\Controllers;


use App\Facades\TemplateFacade;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
  protected $currentRoute = '/Home/index';

  public function __construct()
  {
    LengthAwarePaginator::viewFactoryResolver(function () {
      return TemplateFacade::getTemplateEngine();
    });
  }

  public function index(array $params = null) {

    $alert = $params['alert'] ?? null;
    $taskModel = new Task();
    $tasks = $taskModel->getAll();

    $currentPage = (!is_null($params) && array_key_exists('page', $params)) ? (int)$params['page'] : 1;
    $perPage = 3;
    $currentItems = array_slice($tasks, $perPage * ($currentPage - 1), $perPage);

    $paginator = new LengthAwarePaginator($currentItems, count($tasks), $perPage, $currentPage);

    return parent::render('pages.home', [
      'paginator' => $paginator,
      'alert'     => $alert
    ]);
  }
}