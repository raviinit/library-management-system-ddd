<?php
// Entry point and route requests come here

require_once '../vendor/autoload.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] !== 'api') {
    echo 'Website you are looking for is RESTRICTED.';
    exit();
}

require_once '../config/routecontroller.php';
