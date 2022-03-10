<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Boite;
use CustomBox\Views\ViewRender;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Views\ViewGestionBoite;

class BoiteController extends Controller{
    public function creerBoite(Request $request, Response $response, $parameters):Response{
        $vue=new ViewGestionBoite($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){
            $taille = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $poidsmax = filter_var( $request->getParsedBody()['taille'], FILTER_SANITIZE_NUMBER_INT);

            $parameters['taille']=$taille;
            $parameters['poidsmax']=$poidsmax;
            $this->ajouterBoiteBDD($parameters);
            $response = $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response = $response->getBody()->write($vueRender->render($vue->render(2)));
        }
        return $response;
    }

    public function modifierBoite(Request $request, Response $response, $parameters):Response{
        $vue=new ViewGestionProduits($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){
            $taille = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $poidsmax = filter_var( $request->getParsedBody()['taille'], FILTER_SANITIZE_NUMBER_INT);

            $parameters['taille']=$taille;
            $parameters['poidsmax']=$poidsmax;
            $this->modifierBoiteBDD($parameters);
            $response = $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response = $response->getBody()->write($vueRender->render($vue->render(2)));
        }
        return $response;
    }

    private function ajouterBoiteBDD(array $args){
        $b = new Boite();
        $b->taille = $args["taille"];
        $b->poidsmax = $args["poidsmax"];
        $res=$b->save();
        if (!$res){
            throw new \Exception("Sauvegarde de l'item a échoué");
        }
        return $b;
    }

    private function modifierBoiteBDD(Boite $b, array $args){
        $b->taille = $args["taille"];
        $b->poidsmax = $args["poidsmax"];
        $res=$b->save();
        if (!$res){
            throw new \Exception("Sauvegarde de l'item a échoué");
        }
    }
}
