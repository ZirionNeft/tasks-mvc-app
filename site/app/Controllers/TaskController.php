<?php


namespace App\Controllers;


use App\Core\Form;
use App\Exceptions\InvalidFormException;
use App\Models\Task;

class TaskController extends Controller
{
  protected $currentRoute = '/task/';

  public function create($params = null)
  {
    $this->currentRoute .= 'create';
    $errors = [];
    $data = [];
    $taskCreated = false;

    if(!empty($_POST)) {
      $taskCreatingForm = new Form([
        'username'  => 'name|required',
        'email'     => 'email|required',
        'content'   => 'required'
      ]);

      try {
        $taskCreatingForm->handle();
        $errors = $taskCreatingForm->getErrors();
        $data = $taskCreatingForm->getData();

        if (!$taskCreatingForm->hasErrors()) {
          $task = new Task();
          $taskCreated = (bool)$task->create($data);
        }
      } catch (InvalidFormException $e) {
        echo $e;
      }
    }

    return parent::render('task.create', [
      'errors'      => $errors,
      'data'        => $data,
      'alert'       => $taskCreated ? ['text' => 'Ваша задача успешно создана!', 'status' => 'success'] : null
    ]);
  }

  public function update($params = null)
  {
    $this->currentRoute .= 'update';
    $errors = [];
    $data = [];

    // TODO
  }
}