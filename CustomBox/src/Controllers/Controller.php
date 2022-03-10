<?php

namespace CustomBox\Controllers;

use \Slim\Container;

/*
 * Classe controller qui represente un controlleur abstrait
 */
class Controller
{
    // Attribut
    protected Container $container;

    /**
     * Constructeur qui prend un containeur
     * @param Container $c
     */
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

}