<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Boite;
use CustomBox\Models\Commande;
use CustomBox\Models\Produit;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;
use CustomBox\Views\ViewGestionCommande;

/**
 * Classe Controller qui gère les commandes
 */
class GestionCommandeController extends Controller{

    /**
     * Fonction qui affiche le panier
     */
    public function afficherPanier(Request $request, Response $response, array $parameters):Response
    {
        $vue = new ViewGestionCommande($this->container);
        $response->getBody()->write(($vue->render(1, $parameters)));
        return $response;
    }

    /**
     * Fonction pour ajouter un produit dans le panier
     */
    public function ajouterPanier(Request $request, Response $response, array $param):Response {
        $tab = $_SESSION["panier"];
        $tab[] = $param;
        $_SESSION["panier"] = $tab;
        return $response->withRedirect($this->container->router->pathFor('home'));
    }

    /**
     * Fonction qui valide le panier
     * Si l'user n'est pas connecté, s'affiche une erreur
     * Sinon si l'user a un boite trop remplis, message d'erreur
     * Sinon s'affiche un message de validation et enregistre la commande dans la table sql
     */
    public function validerCommande(Request $request, Response $response, array $parameters):Response {
        $vue = new ViewRender($this->container);
        if(isset($_SESSION['user'])) {
            $tabProduit = $_SESSION["panier"];
            $poid = 0.0;
            foreach ($tabProduit as $prod) {
                $valSql = Produit::find($prod['id']);
                $poid += $valSql->poids;
            }
            $idBoite = 1;
            $boites = Boite::select('*')->orderBy('poidsmax', 'ASC')->get();
            foreach ($boites as $boite) {
                if ( $idBoite==null && $poid < $boite->poidsmax) {
                    $idBoite = $boite->id;
                }
            }
            if ($idBoite!=null) {
                $commande = new Commande();
                $commande->idUser = $_SESSION['user'];
                $commande->etat = "Valider";
                $commande->idBoite = $idBoite;
                $commande->save();
                foreach ($tabProduit as $prod) {
                    Produit::find($prod['id'])->commandes()->save($commande);
                }
                $_SESSION["panier"] = [];
                $response->withRedirect($this->container->router->pathFor('home'));
                $response->getBody()->write($vue->afficherMessage("Votre commande a bien était validé!"));
            } else {
                $response->getBody()->write($vue->afficherErreur("Trop d'article dans votre panier, aucunes boite ne peut supporter un tel poids..."));
            }
        } else {
            $response->getBody()->write($vue->afficherErreur("Il faut être connecter pour valider votre commande!"));
        }
        return $response;
    }

}