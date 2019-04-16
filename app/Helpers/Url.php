<?php

use app\Core\Config;

if (!function_exists('base_url')) {
  function base_url($url = "") {
    return trim(strip_tags(Config::getConfig()['base_url'] . DS . $url));
  }
}
