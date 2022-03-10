<?php

/**
 * Home
 */
$app->get('/', CustomBox\Controllers\HomeController::class . ':index')->setName('home');
