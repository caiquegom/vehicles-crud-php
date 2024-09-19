<?php

require '../vendor/autoload.php';

use app\framework\Router;

$routes = require '../app/routes/routes.php';

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(dirname(__FILE__, 2));
$dotenv->load();

try {
    Router::execute($routes);
} catch (Exception $e) {
    echo $e->getMessage();
}

