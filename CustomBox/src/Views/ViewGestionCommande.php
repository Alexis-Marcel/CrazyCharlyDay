<?php

namespace CustomBox\Views;

use CustomBox\Views\ViewRender;
use Slim\Container;

class ViewGestionCommande
{

    // ATTRIBUTS
    private $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function render(int $code, array $args):string
    {
        $content = "";
        switch ($code){
            case 1 :
                $content = $this->affichagePanier($args);
                break;
            default:
                throw new \Exception("Code d'affichage innatendu");
                break;
        }
        $vue = new ViewRender($this->container);
        return $vue->render($content);
    }

    public function affichagePanier() {

        $tab = $_SESSION["panier"];


        return <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Sign In CustomBox</title>
            
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
                                    <h2 class="form-title">Connexion</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("signup")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="nom"><i class="bi bi-bookmark"></i></label>
                                            <input type="text" name="nom" id="nom" placeholder="Nom de l'article"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc"><i class="bi bi-body-text"></i></label>
                                            <input type="text" name="desc" id="desc" placeholder="Description"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="categ"><i class="bi bi-body-text"></i></label>
                                            <input type="text" name="categ" id="categ" placeholder="Categorie"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="poid"><i class="bi bi-body-text"></i></label>
                                            <input type="text" name="poid" id="poid" placeholder="Poid"/>
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
}
