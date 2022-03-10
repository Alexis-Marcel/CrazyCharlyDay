<?php

namespace CustomBox\Views;

use CustomBox\Models\Categorie;
use CustomBox\Views\ViewRender;
use Slim\Container;

class ViewGestionProduits
{

    // ATTRIBUTS
    private $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function render(int $code, array $args):string//2-3 pris 2 creation, 3 modif
    {
        $content = "";
        switch ($code){
            case 1 :
                $content = $this->affichageCatalogue($args);
                break;
            case 2 :
                $content = $this->affichageCreation();
                break;
            case 3 :
                $content = $this->affichageModification();
                break;
            default:
                throw new \Exception("Code d'affichage innatendu");
                break;
        }
        $vue = new ViewRender($this->container);
        return $vue->render($content);
    }

    private function affichageCatalogue(array $args): string
    {
        $args = $args[0];
        $content = <<<END
 <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">L'ATELIER 17.91</h1>
                    <p class="lead fw-normal text-white-50 mb-0">ATELIERS ITINÉRANTS</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
END;



        foreach ($args as $prod){
            //$categorie = $prod->categorie->nom;
            $content .= <<<END
<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <img class="card-img-top" src="{$this->container->router->pathFor("home")}assets/images/produits/{$prod->id}.jpg" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{$prod->titre}</h5>
                <!-- Product description-->
                <p>{$prod->description}</p>
                <p></p>
                <p>{$prod->poids}kg</p>
            </div>
        </div>
        <!-- Product actions-->
        <form class="card-footer p-4 pt-0 border-top-0 bg-transparent" action="{$this->container->router->pathFor('ajouterPanier', ['id' => $prod->id])}" method="get"> 
            <button type="submit" class="btn btn-outline-secondary">Ajout au panier</button>
        </form>
    </div>
</div>
END;
        }
        return $content .
        '</div>
    </div>
</section>';
    }

    private function affichageCreation():string
    {
        return <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Mon profil</title>
            
                <!-- Font Icon -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/fonts/material-icon/css/material-design-iconic-font.min.css">
            
                <!-- Main css -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/css/sign.css">
            </head>
            <body>
            
                <div class="main">
            
                    <!-- Sign up form -->
                    <section class="signup">
                        <div class="container">
                            <div class="signup-content">
                                <div class="signup-form">
                                    <h2 class="form-title">Creation produit</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("editCompte")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="titre"><i class="bi bi-bookmark"></i></label>
                                            <input type="text" name="titre" id="titre" placeholder="Titre du produit"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description"><i class="bi bi-book"></i></label>
                                            <input type="text" name="description" id="description" placeholder="Description du produit"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="categorie"><i class="bi bi-tags"></i></label>
                                            <input type="text" name="categorie" id="categorie" placeholder="Categorie du produit"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="poid"><i class="bi bi-cloud"></i></label>
                                            <input type="text" name="poid" id="poid" placeholder="Poid du produit"/>
                                        </div>
                                        <div class="form-group form-button">
                                            <input type="submit" name="signup" id="signup" class="form-submit" value="Crée produit"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-image">
                                    <figure><img src="{$this->container->router->pathFor("home")}assets/images/sign/signup-image.jpg" alt="sing up image"></figure>
                                </div>
                            </div>
                        </div>
                    </section>
           
            
                </div>
            
            </body>
            </html>
        END;
    }

    private function affichageModification():string
    {
        return "";
    }


}