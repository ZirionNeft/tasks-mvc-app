<?php


namespace App\Controllers;


use App\Core\Auth;
use App\Core\Form;
use App\Core\Router;
use App\Exceptions\InvalidFormException;

class AdminController extends Controller
{
  protected $currentRoute = '/admin/';

  public function login($params = null)
  {

    $this->currentRoute .= 'login';
    $errors = [];
    $data = [];
    $alert = $params['alert'] ?? null;


    try{
      if (Auth::isLoggedIn()) {
        Router::redirect('/admin/profile');
      }
    } catch (\Exception $e) {
      echo $e;
    }

    if(!empty($_POST)) {
      $loginForm = new Form([
        'login'     => 'name|required',
        'password'  => 'required'
      ]);

      try {
        $loginForm->handle();
        $errors = $loginForm->getErrors();
        $data = $loginForm->getData();

        if (!$loginForm->hasErrors()) {

          if (Auth::login($data['login'], $data['password'])) {
            Router::redirect('/admin/profile', [
              "alert" => [
                "text" => "Вы успешно вошли в систему!",
                "status" => "success"
              ]
            ]);
          } else {
            $alert = ["text" => "Неверные данные для входа", "status" => "danger"];
          }

        }
      } catch (InvalidFormException $e) {
        echo $e;
      } catch (\Exception $e) {
        echo $e;
      }
    }

    return parent::render('pages.login', [
      'errors'  => $errors,
      'data'    => $data,
      'alert'   => $alert
    ]);
  }

  public function profile($params = null)
  {
    $this->currentRoute .= 'profile';

    $alert = $params['alert'] ?? null;

    return parent::render('pages.profile', [
      'alert' => $alert
    ]);
  }

  public function logout($params = null)
  {
    $this->currentRoute .= 'logout';

    Auth::logout();

    Router::redirect('/admin/login', [
      'alert' => [
        'status'  => 'info',
        'text'    => 'Вы вышли из аккаунта'
      ]
    ]);
  }
}