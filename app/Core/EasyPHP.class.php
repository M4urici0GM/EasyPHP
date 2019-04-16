<?php

/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;
use app\Exceptions\CustomErrors;

class EasyPHP {
  private $URL;
  private $rawURL;
  private $Method;
  private $Controller;
  private $ControllerObj;
  private $Arguments;
  private $Config;
  private $helpersFile;
  private $RoutesArr;
  private $actualRoute;

  function __construct($url) {
    $this->rawURL = $url;
    $this->Config = Config::getConfig();
    $this->RoutesArr = Config::getRoutes();
    $this->controllersPath = WWW_ROOT . DS . "app" . DS . "Controllers" . DS;
    $this->helpersFile = array_values(array_diff(scandir(WWW_ROOT . DS . "app" . DS . "Helpers/"), array('..', '.')));
    $this->parseUrl();
  }

  private function parseUrl() {
    $this->URL = explode('/', trim(strip_tags($this->rawURL)));

    foreach ($this->RoutesArr as $route => $value) {
      if ($this->rawURL == $route) {
        $this->actualRoute = $route;
        break;
      }
    }

    if (empty($this->actualRoute)) {
      $this->URL = explode('/', trim(strip_tags($this->rawURL)));
      $this->Controller = ((isset($this->URL[0]) && $this->URL[0] !== "") ? $this->URL[0] : $this->Config['default_controller']);
      unset($this->URL[0]);
      $this->Method = (isset($this->URL[1]) ? $this->URL[1] : $this->Config['default_method']);
      unset($this->URL[1]);
      $this->Arguments = array_values($this->URL);
    } else {
      $route = $this->RoutesArr[$this->actualRoute];
      $routeExploded = explode('/',trim(strip_tags($route)));
      $this->Controller = $routeExploded[0];
      unset($routeExploded[0]);
      $this->Method = (isset($routeExploded[1]) ? $routeExploded[1] : $this->Config['default_method']);
      unset($routeExploded[1]);
      $this->Arguments = array_values($routeExploded);
    }
    $this->next();
  }

  private function next() {
    $this->loadHelpers();

    if (!file_exists($this->controllersPath . $this->Controller . ".class.php")) {
      new CustomErrors(404);
      exit();
    }
    require_once($this->controllersPath . $this->Controller . ".class.php");
    $this->ControllerObj = new $this->Controller;
    if (!method_exists($this->ControllerObj, $this->Method)) {
      return new CustomErrors(404);
    }
    call_user_func_array(array($this->ControllerObj, $this->Method), $this->Arguments);
  }

  private function loadHelpers() {
    foreach ($this->helpersFile as $key => $helper) {
      require_once(WWW_ROOT . DS . "app" . DS . "Helpers/" . $helper);
    }
  }

  public function base_url() {
    return $this->Config['base_url'];
  }

}
