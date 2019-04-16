<?php

/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

class Config {
  function __construct() {}
  public static function getConfig() {
    require (WWW_ROOT . DS . "app". DS ."Config.php" );
    return $config;
  }

  public static function getRoutes() {
    require (WWW_ROOT . DS . "app" . DS . "Routes.php");
    return $routes;
  }
}
