<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/
define('BASEPATH', dirname(__FILE__));
define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
spl_autoload_register('_myAutoLoad');
set_exception_handler("errorHandler");

session_start();

use app\Core\EasyPHP;

$url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

if($url != null && !preg_match("/^[a-z0-9.\-\/]+$/i", $url) ) {
    return exit("Chars not allowed in URL");
}

$triskle = new EasyPHP($url);

function _myAutoLoad( $class ) {
  $class = WWW_ROOT . DS . str_replace( '\\', DS, $class ) . '.class.php';
  if( !file_exists( $class ) ) {
      return new Exception("File {$class} not found");
  }
  require_once ( $class );
}

function errorHandler($exception) {
  echo "Uncaught exception: {$exception->getMessage()} <br/>";
  echo "Trace:  <br />";
  echo " - File: {$exception->getTrace()[0]['file']} <br />";
  echo " - Line: {$exception->getTrace()[0]['line']} <br />";
  echo " - Instruction: {$exception->getTrace()[0]['function']} <br />";
  echo " - On function: {$exception->getTrace()[1]['function']} <br />";
  die();
}
