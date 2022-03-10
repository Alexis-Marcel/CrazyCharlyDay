<?php

namespace Views;

use CustomBox\Views\ViewRender;
use Slim\Container;

class ViewGestionProduits
{

    // ATTRIBUTS
    private $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function render(int $code, array $args):string
    {
        $content = "";
        switch ($code){
            case 1 :
                $content = $this->affichageCatalogue($args);
                break;
            default:
                throw new \Exception("Code d'affichage innatendu");
                break;
        }
        $vue = new ViewRender($this->container);
        return $vue->render($content);
    }

