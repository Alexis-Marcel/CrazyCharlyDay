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

        <h2>Votre panier:</h2>
        <ul>
        </ul>
       

END;

    }
}
