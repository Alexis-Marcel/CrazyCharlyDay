<?php
namespace CustomBox\Views;
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

    public function render(int $code, array $args):string//2-3 pris 2 creation, 3 modif
    {
        $content = "";
        switch ($code){
            case 1 :
                $content = $this->affichageBoites($args);
                break;
            default:
                throw new \Exception("Code d'affichage innatendu");
                break;
        }
        $vue = new ViewRender($this->container);
        return $vue->render($content);
    }

    private function affichageBoite(array $args){
        $content = <<<END

END;
        return $content;
    }
}