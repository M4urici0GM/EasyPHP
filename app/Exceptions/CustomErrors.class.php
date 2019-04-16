<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/
namespace app\Exceptions;
use app\Core\Config;

class CustomErrors {
  private $Config;
  private $ErrorsFolder;

  function __construct($error = 0) {
    $this->Config = Config::getConfig();

    if ($error == 0)  echo "Please, insert an error number! CustomErrors.class.php ";

    switch ($error) {
      case 404:
        $this->requireFile("404");
        break;

      default:
        // code...
        break;
    }
  }

  private function requireFile( $file = "" ) {
    if ($file !== "") {
      $file_path = WWW_ROOT . DS . "app/Views/_errors/{$file}.php";
      if (!file_exists($file_path)) $this->echoDefaultError("Sorry, but this file do not exists. \n ", "404 Not Found");
      require_once($file_path);
    } else {
      exit("please, especify a file to require");
    }
  }
}
