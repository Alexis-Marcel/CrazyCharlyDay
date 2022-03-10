<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Produit;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;
use Views\ViewGestionProduits;

class ProduitController extends Controller{

    public function creerProduit(Request $request, Response $response, $parameters):Response //2
    {
        $vue=new ViewGestionProduits($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){

            $titre = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $description = filter_var( $request->getParsedBody()['description'], FILTER_SANITIZE_STRING);
            $categorie = filter_var( $request->getParsedBody()['request'], FILTER_SANITIZE_STRING);
            $poids = filter_var( $request->getParsedBody()['poids'], FILTER_SANITIZE_NUMBER_FLOAT);

            $parameters["titre"]=$titre;
            $parameters["description"]=$description;
            $parameters["categorie"]=$categorie;
            $parameters["poids"]=$poids;

            $this->ajouterProduitBDD($parameters);
            $response = $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response = $response->getBody()->write($vueRender->render($vue->render(2)));
        }
        return $response;
    }

    public function modifierProduit(Request $request, Response $response, $parameters) //3
    {
        $vue=new ViewGestionProduits($this->container);
        $vueRender = new ViewRender($this->container);

        if($request->isPost()){
            $titre = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $description = filter_var( $request->getParsedBody()['description'], FILTER_SANITIZE_STRING);
            $categorie = filter_var( $request->getParsedBody()['request'], FILTER_SANITIZE_STRING);
            $poids = filter_var( $request->getParsedBody()['poids'], FILTER_SANITIZE_NUMBER_FLOAT);

            $parameters["titre"]=$titre;
            $parameters["description"]=$description;
            $parameters["categorie"]=$categorie;
            $parameters["poids"]=$poids;

            $this->modifierProduitBDD($parameters);


            $response = $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response = $response->getBody()->write($vueRender->render($vue->render(3)));
        }
        return $response;
    }

    private function ajouterProduitBDD(array $args) : Produit{
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

    private function modifierProduitBDD(Produit $p, array $args):void {
        $p->titre = $args['titre'];
        $p->description = $args['description'];
        $p->categorie = $args['categorie'];
        $p->poids = $args['poids'];

        $res = $p->save();
        if (!$res){
            throw new \Exception("Sauvegarde de l'item a échoué");
        }
    }
}