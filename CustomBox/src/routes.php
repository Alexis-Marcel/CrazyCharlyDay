<?php

/**
 * Home
 */
$app->get('/', CustomBox\Controllers\HomeController::class . ':index')->setName('home');
$app->post('/', CustomBox\Controllers\HomeController::class . ':index')->setName('home');
$app->get('/creationProduit', CustomBox\Controllers\ProduitController::class.':creerProduit')->setName("creationProduit");
$app->get('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");
$app->post('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");

