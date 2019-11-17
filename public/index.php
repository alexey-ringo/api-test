<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Api\NewsApi;
use Framework\Core\SillyRouter;
use Framework\Core\Router;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$router = new Router;
echo $router->run();
