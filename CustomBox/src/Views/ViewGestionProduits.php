<?php

namespace CustomBox\Views;

use CustomBox\Models\Categorie;
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

    public function render(int $code, array $args):string//2-3 pris 2 creation, 3 modif
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

    private function affichageCatalogue(array $args): string
    {
        $args = $args[0];
        $content = <<<END
 <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
END;



        foreach ($args as $prod){
            //$categorie = $prod->categorie->nom;
            $content .= <<<END
<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">$prod->titre</h5>
                <!-- Product description-->
                <p>$prod->description</p>
                <p></p>
                <p>$prod->poids</p>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div>
    </div>
</div>
END;
        }
        return $content .
        '</div>
    </div>
</section>';
    }


}