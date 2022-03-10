<?php

namespace CustomBox\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewRender;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $parameters)
    {
        $vue = new ViewRender($this->container);
        $response->getBody()->write($vue->render($vue->affichageAccueil()));
        return $response;
    }
}
