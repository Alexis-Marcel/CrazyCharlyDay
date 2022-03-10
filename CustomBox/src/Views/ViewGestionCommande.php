<?php

namespace CustomBox\Views;

use CustomBox\Models\Produit;
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

    /**
     * Fonction render qui gère toutes les vues concernant la gestion d'une commande
     * @param int $code
     * @param array $args
     * @return string
     * @throws \Exception
     */
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

    /**
     * Fonction d'affichage du panier
     * @return string html
     */
    private function affichagePanier() {

        $tab = null;
        if (isset($_SESSION["panier"])) {
            $tab = $_SESSION["panier"];
        }
        $html = '<div class="div-panier"><div class="panier-titre"><h2>Votre panier :</h2></div><ul>';
        if ($tab!=null){
            foreach ($tab as $value) {
                $html .= "<li class='li-panier'>" . $this->trouverProduit($value["id"])->titre . "</li>";
            }
            $html.= "<form class='card-footer p-4 pt-0 border-top-0 bg-transparent' action='{$this->container->router->pathFor("validerCommande")}' method='post'> 
            <button type='submit' class='btn btn-outline-secondary' id='bouton-panier'>Valider la commande</button>
        </form></div>";
        } else {
            $html.= "Votre panier est vide, retournez à l'accueil pour le compléter";
        }
        return $html;
    }

    /**
     * Methode de recherche d'un produit par id
     * @param $id id produit
     * @return mixed
     */
    public function trouverProduit($id) {
        return Produit::find($id);
    }

}
