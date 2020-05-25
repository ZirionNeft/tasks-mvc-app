<?php

namespace Core;

use PDO;

class Database
{

  /**
   * @var string
   */
  protected static $host;

  /**
   * @var string
   */
  protected static $user;

  /**
   * @var string
   */
  protected static $password;

  /**
   * @var string
   */
  protected static $dbName;

  /**
   * @var int
   */
  protected static $port;

  /**
   * @var PDO
   */
  protected static $connection;

  /**
   * @return PDO
   */
  public function getConnection()
  {
    return self::$connection;
  }

  /**
   * Database constructor.
   * @throws \Exception
   */
  public function __construct()
  {
    $config = Config::getConfig('general', 'database');

    static::$host = $config['host'];
    static::$user = $config['user'];
    static::$password = $config['password'];
    static::$dbName = $config['dbname'];
    static::$port = $config['port'];

    static::initConnection();
  }

  public function initConnection()
  {
    static::$connection = new PDO('pgsql:host='. static::$host .';dbname=' . static::$dbName, static::$user, static::$password);
  }

  /**
   * @param string $sql
   *
   * @return array
   */
  public function fetchAssocArray(string $sql)
  {
    return static::$connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * @param string $sql
   *
   * @return mixed
   */
  public function fetchRow(string $sql)
  {
    return static::$connection->query($sql)->fetchColumn();
  }

  /**
   * @param string $sql
   *
   * @return mixed
   */
  public function fetchArray(string $sql)
  {
    return static::$connection->query($sql)->fetchAll();
  }
}