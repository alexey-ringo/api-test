<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Api\NewsApi;
use Core\Router;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$router = new Router;
echo $router->run();
