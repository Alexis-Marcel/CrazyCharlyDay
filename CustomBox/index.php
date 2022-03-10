<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

\CustomBox\config\Eloquent::start(__DIR__ . '/src/config/dbconfig.ini');

$app = new \Slim\App([
'settings' => [
'displayErrorDetails' => true,
]
]);

$container = $app->getContainer();


require __DIR__ . '/src/routes.php';


$app -> run();