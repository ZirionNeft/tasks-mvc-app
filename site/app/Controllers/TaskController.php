<?php


namespace App\Controllers;


use App\Core\Auth;
use App\Core\Form;
use App\Core\Router;
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
    $alert = $params['alert'] ?? null;

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

          if ($taskCreated) {
            Router::redirect('/', [
              'alert' => [
                'text' => 'Ваша задача успешно создана!',
                'status' => 'success'
              ]
            ]);

            return null;
          }
        }
      } catch (InvalidFormException $e) {
        echo $e;
      }
    }

    return parent::render('task.create', [
      'errors'      => $errors,
      'data'        => $data,
      'alert'       => $alert
    ]);
  }

  public function edit($params = null)
  {
    $this->currentRoute .= 'edit';

    if (!Auth::isLoggedIn()) {
      Router::redirect('/admin/login', [
        'alert' => [
          'status'  => 'warning',
          'text'    => 'Необходима авторизация'
        ]
      ]);

      return null;
    }

    $errors = [];
    $alert = $params['alert'] ?? null;

    $task = new Task();

    if (!isset($params['id']) || !$data = $task->getById($params['id'])) {
      Router::redirect('/', [
        'alert' => [
          'status' => 'danger',
          'text'   => 'Задача с таким ID не найдена'
        ]
      ]);

      return null;
    }

    if(!empty($_POST)) {
      $taskEditForm = new Form([
        'content'   => 'required',
        'done'      => 'checkbox'
      ]);

      try {
        $taskEditForm->handle();
        $errors = $taskEditForm->getErrors();
        $formData = $taskEditForm->getData();

        if (!$taskEditForm->hasErrors()) {
          $task = new Task();

          $data['edited'] = $data['edited'] ?: $data['content'] !== $formData['content'];

          $mergedData = array_merge($data, $formData);
          $taskIsEdited = (bool)$task->update($mergedData);

          if ($taskIsEdited) {
            $data = $mergedData;
            $alert = [
              'status'  => 'success',
              'text'    => 'Задача успешно отредактирована и сохранена'
            ];
          }
        }
      } catch (InvalidFormException $e) {
        echo $e;
      }
    }

    return parent::render('task.edit', [
      'errors' => $errors,
      'data'  => $data,
      'alert' => $alert
    ]);
  }
}