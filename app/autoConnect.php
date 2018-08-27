<?php

require_once ROOT_DIR . '/app/DatabaseConnection.php';
require_once ROOT_DIR . '/app/DatabaseQuery.php';
require_once ROOT_DIR . '/app/Controller.php';
require_once ROOT_DIR . '/app/Router.php';
require_once ROOT_DIR . '/app/Auth.php';
require_once ROOT_DIR . '/app/FlashMessage.php';
require_once ROOT_DIR . '/app/Validator.php';

$paths = array('controller', 'model', 'view');

foreach ($paths as $path) {
    foreach (glob(__DIR__ . "/../$path/*.php") as $root_file) {
        require $root_file;
    }
}

