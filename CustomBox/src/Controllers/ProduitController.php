<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Avis;
use CustomBox\Models\Produit;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use CustomBox\Views\ViewRender;
use CustomBox\Views\ViewGestionProduits;


class ProduitController extends Controller{

    public function creerProduit(Request $request, Response $response, $parameters):Response //2
    {
        $vue=new ViewGestionProduits($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){

            $titre = filter_var( $request->getParam('titre'), FILTER_SANITIZE_STRING);
            $description = filter_var( $request->getParam('description'), FILTER_SANITIZE_STRING);
            $categorie = filter_var( $request->getParam('categorie'), FILTER_SANITIZE_STRING);
            $poids = filter_var( $request->getParam('poids'), FILTER_SANITIZE_NUMBER_FLOAT);

            $parameters["titre"]=$titre;
            $parameters["description"]=$description;
            $parameters["categorie"]=$categorie;
            $parameters["poids"]=$poids;

            $this->ajouterProduitBDD($parameters);
            $response->getBody()->write($vueRender->afficherMessage("Votre produit a bien été créé"));
        } else {
            $response->getBody()->write($vue->render(2, $parameters));
        }
        return $response;
    }

    public function modifierProduit(Request $request, Response $response, $parameters) //3
    {
        $vue=new ViewGestionProduits($this->container);
        $vueRender = new ViewRender($this->container);

        if($request->isPost()){
            $titre = filter_var( $request->getParam('titre'), FILTER_SANITIZE_STRING);
            $description = filter_var( $request->getParam('description'), FILTER_SANITIZE_STRING);
            $categorie = filter_var( $request->getParam('categorie'), FILTER_SANITIZE_NUMBER_INT);
            $poids = filter_var( $request->getParam('poids'), FILTER_SANITIZE_NUMBER_FLOAT);

            $parameters["titre"]=$titre;
            $parameters["description"]=$description;
            $parameters["categorie"]=$categorie;
            $parameters["poids"]=$poids;

            $produit = $this->recupererProduit($parameters["idProduit"]);

            $this->modifierProduitBDD($produit,$parameters);


            $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response->getBody()->write($vue->render(3, $parameters));
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
    private function recupererProduit(int $id): ?Produit{
        try {
            return Produit::query()->where('id', '=', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }


    /**
     * Generere l'affichage du catalogue
     */
    public function affichageCatalogue(Request $rq, Response $rs, array $args): Response
    {
        try {
            $vue = new ViewGestionProduits($this->container);

            //on recupere les items
            $produits = Produit::query()->select('*')->get();

            $rs->getBody()->write($vue->render(1, [$produits]));
        } catch (\Exception $e) {
            $vue = new ViewRender($this->container);
            $rs->getBody()->write($vue->render($vue->afficherErreur("Erreur dans l'affichage du catalogue...".$e->getMessage()."<br>".$e->getTrace())));
        }
        return $rs;
    }

    /**
     * Generere l'affichage du catalogue
     */
    public function affichageProduit(Request $rq, Response $rs, array $args): Response
    {
        try {
            $id =  filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

            $vue = new ViewGestionProduits($this->container);
            //on recupere les items
            $produit = Produit::query()->select('*')->where('id', "=", $id)->firstOrFail();

            $rs->getBody()->write($vue->render(4, [$produit]));
        } catch (\Exception $e) {
            $vue = new ViewRender($this->container);
            $rs->getBody()->write($vue->render($vue->afficherErreur("Erreur dans l'affichage du catalogue...".$e->getMessage()."<br>".$e->getTrace())));
        }
        return $rs;
    }

    public function ajouterAvis($rq, $rs, array $args):Response{
        try {

            if ($rq->isPost() && isset($_SESSION['user'])) {
                //on est dans un post
                $note = filter_var( $rq->getParsedBody()['note'], FILTER_SANITIZE_NUMBER_INT);
                $commentaire = filter_var( $rq->getParsedBody()['commentaire'], FILTER_SANITIZE_STRING);
                $idProduit = filter_var( $args['id'], FILTER_SANITIZE_NUMBER_INT);
                $produit = Produit::query()->where('id', '=', $idProduit)->firstOrFail();

                $avis = new Avis();
                $avis->idProduit = $produit->id;
                $avis->auteur =  $_SESSION['user'];
                $avis->note =  $note;
                $avis->commentaire =  $commentaire;
                $avis->date = date("D/m/Y");
                $avis->save();


                $rs = $rs->withRedirect($this->container->router->pathFor('afficherProduit', ['id' => $produit->id]));
            }
        } catch (\Exception $e) {
            $vue = new ViewRender($this->container);
            $rs->getBody()->write($vue->render($vue->afficherErreur("Erreur dans l'ajout d'un avis...".$e->getMessage()."<br>".$e->getTrace())));
        }
        return $rs;
    }




}