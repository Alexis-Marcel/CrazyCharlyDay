<?php
declare(strict_types=1);

// NAMESPACE
namespace CustomBox\Views;

// IMPORTS
use Slim\Container;

/**
 * Classe VueRender
 *
 */
class ViewRender
{

    // ATTRIBUTS
    private Container $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    // METHODES

    /**
     * Fonction qui retourne l'affichage général du site web
     * @param $content Container
     * @return string String: texte html, cointenu global de chaque page
     * @author Lucas Weiss
     */
    public function render(string $content): string
    {
        return <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <title>CustomBox</title>
                <!-- Favicon-->
                <link rel="icon" type="image/x-icon" href="{$this->container->router->pathFor("home")}assets/favicon.ico" />
                <!-- Bootstrap icons-->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
                <!-- Core theme CSS (includes Bootstrap)-->
                <link href="{$this->container->router->pathFor("home")}assets/css/style.css" rel="stylesheet" />
            </head>
            <body>
                <!-- Navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                    <div class="container px-4 px-lg-5 ">
                        <a class="navbar-brand" href="#!"><img style="width: 40px" src="{$this->container->router->pathFor("home")}assets/logo.png"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="d-flex">              
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                    <li class="nav-item"><a class="nav-link" href="#!">Connexion</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{$this->container->router->pathFor("signin")}">Inscription</a></li>
                                </ul>
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Cart
                                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
                
                $content;
                
                                
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
            </body>
        </html>
        END;
    }

    /**
     * Génère un mesage d'erreur
     * @param string $message message d'erreur
     * @return string html a afficher
     */
    public function afficherErreur(string $message)
    {
        return <<<END
            <div class="block-heading">
                <h2 class="text-info">Erreur</h2>
                <p>$message</p>
            </div>
END;
    }

}