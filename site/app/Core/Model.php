<?php

namespace App\Core;

use PDO;

abstract class Model
{

  /**
   * @var string
   */
  private static $host;

  /**
   * @var string
   */
  private static $user;

  /**
   * @var string
   */
  private static $password;

  /**
   * @var string
   */
  private static $dbName;

  /**
   * @var int
   */
  private static $port;

  /**
   * @var PDO
   */
  private static $connection;

  /**
   * @return PDO
   */
  protected static function getConnection(): PDO
  {
    try {
      self::initConnection();
    } catch (\Exception $e) {
      echo $e;
    }

    return self::$connection;
  }

  /**
   * @throws \Exception
   */
  private static function initConnection(): void
  {
    $config = Config::getConfig('general', 'database');

    static::$host = $config['host'];
    static::$user = $config['user'];
    static::$password = $config['password'];
    static::$dbName = $config['dbname'];
    static::$port = $config['port'];

    self::$connection = new PDO('pgsql:host='. static::$host .';dbname=' . static::$dbName, static::$user, static::$password);
  }

  /**
   * @param string $sql
   *
   * @return array
   */
  public static function fetchAssocArray(string $sql): array
  {
    self::checkConnection();
    return self::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * @param string $sql
   *
   * @return mixed
   */
  public static function fetchRow(string $sql)
  {
    self::checkConnection();
    return self::$connection->query($sql)->fetchColumn();
  }

  /**
   * @param string $sql
   *
   * @return mixed
   */
  public static function fetchArray(string $sql): array
  {
    self::checkConnection();
    return self::$connection->query($sql)->fetchAll();
  }

  private static function checkConnection()
  {
    try {
      if (is_null(self::$connection)) {
        self::initConnection();
      }
    } catch (\Exception $e) {
      echo $e;
    }
  }

}