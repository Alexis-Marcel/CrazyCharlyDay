<?php

namespace CustomBox\Controllers;

use CustomBox\Views\ViewAffichageUser;
use CustomBox\Views\ViewRender;
use Illuminate\Support\Facades\View;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Models\User;
use CustomBox\Views\ViewSign;

/**
 * Classe controlleur qui affiche les utilisateurs (admin)
 */
class AffichageUsers extends Controller
{

    /**
     * Fonctionnalité qui affiche les utilisateurs existants
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getAffichage(Request $request, Response $response)
    {
        $vue = new ViewRender($this->container);
        $vueSignIn = new ViewAffichageUser($this->container);
        $response->getBody()->write($vue->render($vueSignIn->affichageUser()));
        return $response;
    }


}