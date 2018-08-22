<?php

session_start();
define('ROOT_DIR', getcwd());

require ROOT_DIR . '/app/autoConnect.php';

require ROOT_DIR . '/view/layout/main.php';
require ROOT_DIR . '/view/layout/_partial/unsetFormData.php';

use App\Router;

$router = new Router();
require 'routes.php';
$router->resolveUri();

require ROOT_DIR . '/view/layout/footer.php';

// put your code here
?>
