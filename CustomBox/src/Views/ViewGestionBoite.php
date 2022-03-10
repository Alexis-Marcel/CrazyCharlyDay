<?php
namespace CustomBox\Views;
use Slim\Container;

class ViewGestionBoite
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
                $content = $this->affichageBoite($args);
                break;
            default:
                throw new \Exception("Code d'affichage innatendu");
                break;
        }
        $vue = new ViewRender($this->container);
        return $vue->render($content);
    }

    private function affichageBoite(array $args){
        $content = <<<END
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
                                    <h2 class="form-title">Creation Boite</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("editCompte")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="nom"><i class="bi bi-bookmark"></i></label>
                                            <input type="text" name="titre" id="titre" placeholder="Titre du produit"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="taille"><i class="bi bi-book"></i></label>
                                            <input type="float" name="taille" id="taille" placeholder="Description du produit"/>
                                        </div>
                                        <div class="form-group form-button">
                                            <input type="submit" name="signup" id="signup" class="form-submit" value="Crée Boite"/>
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
        return $content;
    }
}