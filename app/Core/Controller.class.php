<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

use app\Core\Input;
use app\Core\Session;
use app\Core\Load;

class Controller{
  public $input;
  public $session;
  private $template;
  private $modelFolder;
  private $modelFile;

  function __construct() {
    $this->input       = new Input();
    $this->session     = new Session();
    $this->template    = array('header' => [], 'footer' => []);
    $this->modelFolder = WWW_ROOT . DS . "app" . DS . "Models" . DS;
  }

  public function view($view = "", $data = []) {
    extract($data);
    if ($view !== "") {
      if ( !file_exists(WWW_ROOT . DS . "app" . DS . "Views" . DS . $view . ".php") ) {
        exit("View not found: {$view}");
      }
      if ($this->template['header']) {
        require_once ( WWW_ROOT . DS . "app" . DS . "Views" . DS . $this->template['header'] . ".php" );
      }
      require_once ( WWW_ROOT . DS . "app" . DS . "Views" . DS . $view . ".php" );
      if ($this->template['footer']) {
        require_once ( WWW_ROOT . DS . "app" . DS . "Views" . DS . $this->template['footer'] . ".php" );
      }
    } else {
      exit("Please, expecify an view name!.");
    }
  }

  public function model($modelName) {
    if (!empty($model)) {
      throw new \InvalidArgumentException("Model name needed!");
      die();
    }

    if (!file_exists($this->modelFolder . $modelName . ".class.php")) {
      throw new \InvalidArgumentException("Model file not found!, did you named the class correctly ?");
      die();
    }

    require_once($this->modelFolder . $modelName . ".class.php");
    $this->$modelName = new $modelName;
    return $this->$modelName;
  }

  public function setTemplate($header = "", $footer = "") {
    if ($header && $footer) {
      $this->template['header'] = $header;
      $this->template['footer'] = $footer;
    } else {
      exit("Please, especify a header AND a footer");
    }
  }

  public function redirect($url){
    $baseUrl = Config::getConfig()['base_url'];
    if (strpos($url, 'http')){

    } else {
      header("Location: {$url}");
    }
  }

}
