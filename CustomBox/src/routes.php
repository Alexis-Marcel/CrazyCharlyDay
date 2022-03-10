<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/* Home */
$app->post('/', CustomBox\Controllers\HomeController::class . ':index')->setName('home');
$app->get('/', \CustomBox\Controllers\ProduitController::class . ':affichageCatalogue')->setName('home');

/* Fct creation de produit */
$app->get('/creationProduit', CustomBox\Controllers\ProduitController::class.':creerProduit')->setName("creationProduit");
$app->get('/afficherProduit/{id}[/]', CustomBox\Controllers\ProduitController::class.':affichageProduit')->setName("afficherProduit");
$app->post('/ajouterCommentaire/{id}[/]', CustomBox\Controllers\ProduitController::class.':ajouterAvis')->setName("ajouterAvis");

/* Fct modification de produit */
$app->get('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");
$app->post('/modificationProduit', CustomBox\Controllers\ProduitController::class.':modifierProduit')->setName("modifierProduit");

/* Fct creation de boite */
$app->get('/creationBoite', \CustomBox\Controllers\BoiteController::class.':creerBoite')->setName("creationBoite");

/* Fct modification de boite */
$app->get('/modificationBoite', CustomBox\Controllers\BoiteController::class.':modifierBoite')->setName("modifierBoite");
$app->post('/modificationBoite', CustomBox\Controllers\BoiteController::class.':modifierBoite');

/* Fct d'identification d'un compte */
$app->get('/signin', CustomBox\Controllers\Authentification::class . ':getSignIn')->setName('signin');
$app->post('/signin', CustomBox\Controllers\Authentification::class . ':postSignIn');

/* Fct pour creer un comtpe */
$app->get('/signup', CustomBox\Controllers\Authentification::class . ':getSignUp')->setName('signup');
$app->post('/signup', CustomBox\Controllers\Authentification::class . ':postSignUp');

/* Fct pour se deconnecter de son compte courant */
$app->get('/signout', CustomBox\Controllers\Authentification::class . ':getSignOut')->setName('signout');

/* Fct pour editer son compte courant */
$app->get('/editCompte', CustomBox\Controllers\Authentification::class . ':getEditCompte')->setName('editCompte');
$app->post('/editCompte', CustomBox\Controllers\Authentification::class . ':postEditCompte');

/* Fct pour afficher tous les utilisateurs (admin) */
$app->get('/affichageUser', CustomBox\Controllers\AffichageUsers::class . ':getAffichage')->setName('affichageUser');

/* Fct pour afficher son panier */
$app->get('/panier', CustomBox\Controllers\GestionCommandeController::class.':afficherPanier')->setName("panier");

/* Fct pour ajouter un produit dans son panier */
$app->get('/ajouterPanier/{id}', CustomBox\Controllers\GestionCommandeController::class.':ajouterPanier')->setName("ajouterPanier");

/* Fct pour valider sa commande */
$app->post('/validerCommande', CustomBox\Controllers\GestionCommandeController::class.':validerCommande')->setName("validerCommande");


