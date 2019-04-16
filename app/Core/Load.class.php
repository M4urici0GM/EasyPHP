<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

class Load {

  private $modelFolder;
  private $modelFile;

  function __construct() {
    $this->modelFolder = WWW_ROOT . DS . "app" . DS . "Models" . DS;
  }

  /*
    @param STRING $model = Model name.
  */
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
}
