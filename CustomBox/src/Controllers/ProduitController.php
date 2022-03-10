<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Produit;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;

class ProduitController extends Controller{

    public function creerProduit(Request $request, Response $response, $parameters):Response
    {
        if ($request->isPost()){

            /**
             * FILTER_SANITIZE des parametres
             */


            $this->ajouterProduitBDD($parameters);
        }
        return $response;
    }

    public function ajouterProduitBDD(array $args) : Produit{
        $p = new Produit();
        $p->titre = $args['titre'];
        $p->description = $args['description'];
        $p->categorie = $args['categorie'];
        $p->poids = $args['poids'];

        $res = $p->save();
        if (!$res){
            throw new \Exception("Sauvegarde de l'item a échoué");
        }
        return $p;
    }

    public function modifierProduit(Request $request, Response $response, $parameters)
    {

    }
}