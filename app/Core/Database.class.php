<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

use app\Core\Config;

class Database{

  private $pdo;
  private $config;
  private $connString;
  private $databaseOptions;

  function __construct() {
    $this->config = Config::getConfig();
    if (!isset($this->config['database'])) {
      throw new \InvalidArgumentException("Database settings not defined on config file");
      die();
    }
    $this->databaseOptions = $this->config['database'];
    if (isset($this->databaseOptions['hostname']) && isset($this->databaseOptions['username']) && isset($this->databaseOptions['password']) && isset($this->databaseOptions['port'])) {
      
    } else {
      throw new \InvalidArgumentException("Check all database parameters");
      die();
    }
  }



}
