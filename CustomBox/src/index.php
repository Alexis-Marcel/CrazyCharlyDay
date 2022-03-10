<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

/**
 * Eloquent
 */
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$db->addConnection(parse_ini_file('src/config/dbconfig.ini'));
$db->setAsGlobal();
$db->bootEloquent();





$app = new \Slim\App([
'settings' => [
'displayErrorDetails' => true,
]
]);

$container = $app->getContainer();



\CustomBox\config\Eloquent::start(__DIR__ . '/config/dbconfig.ini.txt');

require __DIR__ . 'routes.php';