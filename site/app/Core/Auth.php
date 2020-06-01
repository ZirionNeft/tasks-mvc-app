<?php


namespace App\Core;


class Auth
{

  /**
   * @param string $login
   * @param string $password
   * @return bool
   * @throws \Exception
   */
  public static function login(string $login, string $password): bool
  {
    $session = new Session();

    if (self::checkCredentials($login, $password)) {

      $session->register(120);
      $session->set('username', $login);

      return true;
    }

    return false;
  }

  public static function currentUsername(): string
  {
    $session = new Session();
    return $session->get('username');
  }

  public static function isLoggedIn(): bool
  {
    $session = new Session();

    if ($session->isRegistered()) {
      if ($session->isExpired()) {
        $session->end();
        return false;
      } else {
        $session->renew();
        return true;
      }
    }

    return false;
  }

  public static function logout($redirectToHome = false): void
  {
    $session = new Session();
    $session->end();

    if ($redirectToHome) {
      Router::redirect('/');
    }
  }

  /**
   * @param string $login
   * @param string $password
   * @return bool
   * @throws \Exception
   */
  private static function checkCredentials(string $login, string $password): bool
  {
    return $login === Config::getConfig('general', 'admin')['login']
      && password_verify($password, Config::getConfig('general', 'admin')['password']);
  }
}