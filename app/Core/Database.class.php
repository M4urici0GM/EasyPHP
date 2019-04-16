<?php
/*
* M4urici0GM
* https://github.com/M4urici0GM
* https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

use app\Core\Config;

class Database{

  private $config;
  private $connString;
  private $databaseOptions;
  private $databaseConnection;

  function __construct() {
    $this->config = Config::getConfig();
    if (!isset($this->config['database'])) {
      throw new \InvalidArgumentException("Database settings not defined on config file");
      die();
    }
    $this->databaseOptions = $this->config['database'];
    if (isset($this->databaseOptions['hostname']) && isset($this->databaseOptions['username']) && isset($this->databaseOptions['password']) && isset($this->databaseOptions['port']) &&
    isset($this->databaseOptions['database'])) {

      $this->connString          = "pgsql:host={$this->databaseOptions['hostname']}; dbname={$this->databaseOptions['database']};";
      try {
        $this->databaseConnection = new \PDO($this->connString, $this->databaseOptions['username'], $this->databaseOptions['password']);
        $this->databaseConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      } catch(\PDOException $ex) {
        throw new \Exception($ex);
        die();
      }

    } else {
      throw new \InvalidArgumentException("Check all database parameters");
      die();
    }
  }
  public function getConnection() { return $this->databaseConnection; }

  /**
  * @param $sql
  * @param $values
  * @return string
  */
  private function executeInsert($sql, $values) {
    return '';
  }
  /**
  * @param $sql
  * @param $values
  * @return array
  */
  private function executeSelect($sql, $values) {
    return [];
  }
  /**
  * @param $sql
  * @param $values
  * @return int
  */
  private function executeUpdate($sql, $values) {
    return 0;
  }
  /**
  * @param $sql
  * @param $values
  * @return int
  */
  private function executeDelete($sql, $values)  {
    return 0;
  }

}
