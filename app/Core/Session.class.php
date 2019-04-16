<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

use app\Core\Config;

class Session {
  private $config;

  function __construct() {
    $this->config = Config::getConfig();
  }

  public function getSession($index) {
    if (isset($_SESSION[$index])) {
      return $_SESSION[$index];
    } else {
      throw new \InvalidArgumentException("Session {$index} not found.");
      exit();
    }
  }

  public function hasUserData($index) {
    return isset($_SESSION[$index]);
  }

}
