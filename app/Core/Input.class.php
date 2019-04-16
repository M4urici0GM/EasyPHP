<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

namespace app\Core;

class Input {
  public function __construct() {}
  public function post($index = "") {
    $postData = ($index !== "") ? filter_input(INPUT_POST, $index, FILTER_DEFAULT) : filter_input_array(INPUT_POST, FILTER_DEFAULT);
    return trim(strip_tags($postData));
  }
  public function get($index = "") {
    $postData = ($index !== "") ? filter_input(INPUT_GET, $index, FILTER_DEFAULT) : filter_input_array(INPUT_GET, FILTER_DEFAULT);
    return $postData;
  }
}
