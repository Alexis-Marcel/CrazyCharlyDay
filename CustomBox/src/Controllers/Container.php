<?php

namespace CustomBox\Controllers;

use \Slim\Container;

class Controller
{
    protected Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;
    }

}