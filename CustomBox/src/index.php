<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
'settings' => [
'displayErrorDetails' => true,
]
]);

$container = $app->getContainer();

\CustomBox\config\Eloquent::start(__DIR__ . '/config/dbconfig.ini.txt');

require __DIR__ . 'routes.php';