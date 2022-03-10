<?php

/**
 * Home
 */

$app->get('/', \CustomBox\Controllers\ProduitController::class . ':affichageCatalogue')->setName('home');

$app->get('/creationProduit', CustomBox\Controllers\ProduitController::class.':creerProduit')->setName("creationProduit");

$app->get('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");
$app->post('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");

$app->get('/signin', CustomBox\Controllers\Authentification::class . ':getSignIn')->setName('signin');
