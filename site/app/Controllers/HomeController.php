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

    $order = [
      'column'  => $_COOKIE['order_column'] ?? '1',
      'type'    => $_COOKIE['order_type'] ?? '1'
    ];

    $alert = $params['alert'] ?? null;
    $taskModel = new Task();
    $tasks = $taskModel->getAll(
      $order['column'] == '3' ? 'done' : ($order['column'] == '2' ? 'username' : 'email'),
      $order['type'] == '1' ? Task::ORDER_DESC : Task::ORDER_ASC
    );

    $currentPage = (!is_null($params) && array_key_exists('page', $params)) ? (int)$params['page'] : 1;
    $perPage = 3;
    $currentItems = array_slice($tasks, $perPage * ($currentPage - 1), $perPage);

    $paginator = new LengthAwarePaginator($currentItems, count($tasks), $perPage, $currentPage);

    return parent::render('pages.home', [
      'paginator' => $paginator,
      'alert'     => $alert,
      'order'     => $order
    ]);
  }
}