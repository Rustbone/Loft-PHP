<?php
define('PROJECT_ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..');

define('DB_HOST', 'localhost');
define('DB_NAME', 'Week3');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

const ADMIN_IDS = [9];

function d(...$args) {
  var_dump($args);
  die;
}