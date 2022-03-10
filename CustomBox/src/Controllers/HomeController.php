<?php

namespace CustomBox\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;

/**
 * Classe controlleur qui gère la page d'accueil
 */
class HomeController extends Controller
{

    /**
     * Fonction get qui gère l'affichage de la page d'accueil c'est a dire la liste des produits
     * @param Request $request
     * @param Response $response
     * @param $parameters
     * @return Response
     */
    public function index(Request $request, Response $response, $parameters)
    {
        $vue = new ViewRender($this->container);
        $response->getBody()->write($vue->render($vue->affichageAccueil()));
        return $response;
    }
}
