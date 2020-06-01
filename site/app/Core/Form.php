<?php


namespace App\Core;


use App\Exceptions\InvalidFormException;

class Form
{
  protected $fields;
  protected $data;
  protected $errors;

  public function __construct(array $fields = [])
  {
    $this->fields = $fields;
    $this->data = [];
    $this->errors = [];
  }

  /**
   * @return void
   * @throws InvalidFormException
   */
  public function handle(): void
  {
    if($this->checkFields())
      throw new InvalidFormException("Wrong form fields");

    foreach ($_POST as $key => $value) {
      if (array_key_exists($key, $this->fields)) {
        $this->data[$key] = self::checkInputValue($value);
      }
    }

    $this->validateFields();
  }

  private function validateFields(): void
  {
    foreach ($this->fields as $field => $rule)
    {
      $rules = explode('|', $rule);
      $errors = [];

      if (empty($this->data[$field]) && in_array('required', $rules)) {
        $errors = array_merge($errors, ["Поле обязательно для заполнения"]);
      }

      if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL) && in_array('email', $rules)) {
        $errors = array_merge($errors, ["Поле должно быть типа E-mail"]);
      }
      elseif (!preg_match("/^[a-z0-9_-]{3,16}$/", $this->data[$field]) && in_array('name', $rules)) {
        $errors = array_merge($errors, ["Поле должно быть длиной от 3 до 16 и не содержать спец.символов"]);
      }
      elseif (in_array('checkbox', $rules)) {
        if (!isset($this->data[$field])) {
          $this->data[$field] = false;
        } else {
          $this->data[$field] = (bool)$this->data[$field];
        }
      }

      if (!empty($errors))
        $this->errors[$field] = $errors;
    }
  }

  private function checkFields()
  {
    if (!self::isAssoc($this->fields))
      return false;

    foreach ($this->fields as $key)
    {
      if (!isset($_POST[$key])) {
        return false;
      }
    }
    return true;
  }

  /**
   * @param $data
   * @return string
   */
  private static function checkInputValue($data): string
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  /**
   * @param array $arr
   * @return bool
   */
  private static function isAssoc(array $arr): bool
  {
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
  }

  /**
   * @return bool
   */
  public function hasErrors(): bool
  {
    return !empty($this->errors);
  }

  /**
   * @return array
   */
  public function getData(): array
  {
    return $this->data;
  }

  /**
   * @return array
   */
  public function getErrors(): array
  {
    return $this->errors;
  }
}