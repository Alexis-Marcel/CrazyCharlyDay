<?php
namespace CustomBox\Controllers;

use CustomBox\Models\Boite;
use CustomBox\Views\ViewGestionProduits;
use CustomBox\Views\ViewRender;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use CustomBox\Views\ViewGestionBoite;

class BoiteController extends Controller{
    public function creerBoite(Request $request, Response $response, $parameters):Response{
        $vue=new ViewGestionBoite($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){
            $taille = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $poidsmax = filter_var( $request->getParsedBody()['taille'], FILTER_SANITIZE_NUMBER_FLOAT);

            $parameters['taille']=$taille;
            $parameters['poidsmax']=$poidsmax;
            $this->ajouterBoiteBDD($parameters);
            $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $response->getBody()->write($vueRender->render($vue->render(1, $parameters)));
        }
        return $response;
    }

    public function modifierBoite(Request $request, Response $response, $parameters):Response{
        $vue=new ViewGestionBoite($this->container);
        $vueRender = new ViewRender($this->container);
        if ($request->isPost()){
            $taille = filter_var( $request->getParsedBody()['titre'], FILTER_SANITIZE_STRING);
            $poidsmax = filter_var( $request->getParsedBody()['taille'], FILTER_SANITIZE_NUMBER_INT);

            $parameters['taille']=$taille;
            $parameters['poidsmax']=$poidsmax;

            $boite = $this->recupererBoite($parameters["idBoite"]);
            $this->modifierBoiteBDD($boite, $parameters);
            $response->withRedirect($this->container->router->pathFor('home'));
        } else {
            $v = new ViewGestionProduits($this->container);
            $response->getBody()->write($vueRender->render($v->render(1,$parameters)));
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
    private function recupererBoite(int $id): ?Boite{
        try {
            return Boite::query()->where('id', '=', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
