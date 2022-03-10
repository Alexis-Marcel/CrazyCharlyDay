<?php

/**
 * Home
 */


$app->get('/', \CustomBox\Controllers\HomeController::class . ':affichageCatalogue')->setName('home');

$app->get('/creationProduit', CustomBox\Controllers\ProduitController::class.':creerProduit')->setName("creationProduit");
$app->get('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");
$app->post('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");

$app->get('/creationBoite', \CustomBox\Controllers\BoiteController::class.'creerBoite')->setName("creationBoite");
$app->get('/modificationBoite', CustomBox\Controllers\ProduitController::class.':modifierBoite')->setName("modifierBoite");
$app->post('/modificationBoite', CustomBox\Controllers\ProduitController::class.':modifierBoite')->setName("modifierBoite ");

