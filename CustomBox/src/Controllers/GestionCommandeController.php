<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Boite;
use CustomBox\Models\Commande;
use CustomBox\Models\Produit;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;
use CustomBox\Views\ViewGestionCommande;

class GestionCommandeController extends Controller{

    public function afficherPanier(Request $request, Response $response, array $parameters):Response
    {
        $vue = new ViewGestionCommande($this->container);
        $response->getBody()->write(($vue->render(1, $parameters)));
        return $response;
    }

    public function ajouterPanier(Request $request, Response $response, array $param):Response {
        $tab = $_SESSION["panier"];
        $tab[] = $param;
        $_SESSION["panier"] = $tab;
        return $response->withRedirect($this->container->router->pathFor('home'));
    }

    public function validerCommande(Request $request, Response $response, array $parameters):Response {

        if(isset($_SESSION['user'])) {
            $tabProduit = $_SESSION["panier"];
            $poid = 0;
            foreach ($tabProduit as $prod) {
                $poid += Produit::find($prod)->poids;
            }
            $idBoite = null;
            $boites = Boite::select('*')->orderBy('poidsmax', 'ASC')->get();
            foreach ($boites as $boite) {
                if ($poid < $boite->poidsmax) {
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
                    Produit::find($prod)->commandes()->save($commande);
                }
                $_SESSION["panier"] = [];
            } else {
                // lancer une alerte demande trop lourde
            }
        } else {
            // lancer une alerte car non connecté
        }
        return $response->withRedirect($this->container->router->pathFor('home'));
    }

}