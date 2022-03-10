<?php
namespace CustomBox\Controllers;

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
        $tab[] = $param->id;
        $_SESSION["panier"] = $tab;
        return $response->withRedirect($this->container->router->pathFor('home'));
    }

}