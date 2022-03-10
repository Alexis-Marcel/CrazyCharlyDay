<?php

namespace CustomBox\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $parameters)
    {
        $vue = new VueRender($this->container);
        $response->getBody()->write($vue->render($vue->affichageAccueil()));
        return $response;
    }
}
