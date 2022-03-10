<?php

namespace CustomBox\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Views\ViewSign;

class Authentification extends Controller
{

    public function getSignIn(Request $request, Response $response)
    {
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write("Inscription");
        return $response;
    }
}