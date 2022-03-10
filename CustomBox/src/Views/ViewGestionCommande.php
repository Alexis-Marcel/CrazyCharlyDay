<?php

namespace CustomBox\Views;

use CustomBox\Controllers\ProduitController;
use CustomBox\Models\Produit;
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

    private function affichagePanier() {

        $tab = null;
        if (isset($_SESSION["panier"])) {
            $tab = $_SESSION["panier"];
        }
        $html = '<div class="div-panier"><h2>Votre panier :</h2><ul>';
        if ($tab!=null){
            foreach ($tab as $value) {
                $html .= "<li>" . $this->trouverProduit($value["id"])->titre . "</li>";
            }
            $html.= "<form class='card-footer p-4 pt-0 border-top-0 bg-transparent' action='{$this->container->router->pathFor("validerCommande")}' method='post'> 
            <button type='submit' class='btn btn-outline-secondary'>Valider la commande</button>
        </form></div>";
        } else {
            $html.= "Votre panier est vide, retournez à l'accueil pour le compléter";
        }
        return $html;
    }

    public function trouverProduit($id) {
        return Produit::find($id);
    }

}
