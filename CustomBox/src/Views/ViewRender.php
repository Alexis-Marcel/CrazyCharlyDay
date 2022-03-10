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
        <html lang="fr">
            <head>
            
              <!-- SITE TITTLE -->
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>CustomBox</title>
              
              <!-- FAVICON -->
              <link href="img/favicon.png" rel="shortcut icon">
              <!-- PLUGINS CSS STYLE -->
              <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
              <!-- Bootstrap -->
              <link rel="stylesheet" href="{$this->container->router->pathFor("home")}plugins/bootstrap/css/bootstrap.min.css">
              <link rel="stylesheet" href="{$this->container->router->pathFor("home")}plugins/bootstrap/css/bootstrap-slider.css">
              <!-- Font Awesome -->
              <link href="{$this->container->router->pathFor("home")}plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              <!-- Owl Carousel -->
              <link href="{$this->container->router->pathFor("home")}plugins/slick-carousel/slick/slick.css" rel="stylesheet">
              <link href="{$this->container->router->pathFor("home")}plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
              <!-- Fancy Box -->
              <link href="{$this->container->router->pathFor("home")}plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
              <link href="{$this->container->router->pathFor("home")}plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
              <!-- CUSTOM CSS -->
              <link href="{$this->container->router->pathFor("home")}css/style.css" rel="stylesheet">
            
            </head>
            <body>
                <header>
                    <h1>Navigation</h1>
                </header>
                    <main class="page landing-page">
                        <section class="clean-block clean-info dark">
                            <div class="container">
                                $content
                            </div>
                        </section>
                    </main>
                  <!-- Container End -->
        </footer>
        <!-- Footer Bottom -->
        <footer class="footer-bottom">
          <!-- Container Start -->
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-12">
                <!-- Copyright -->
                <div class="copyright">
                  <p>Copyright © <script>
                      var CurrentYear = new Date().getFullYear()
                      document.write(CurrentYear)
                    </script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com" target="_blank">themefisher.com</a></p>
                </div>
              </div>
              <div class="col-sm-6 col-12">
                <!-- Social Icons -->
                <ul class="social-media-icons text-right">
                  <li><a class="fa fa-facebook" href="https://www.facebook.com/themefisher" target="_blank"></a></li>
                  <li><a class="fa fa-twitter" href="https://www.twitter.com/themefisher" target="_blank"></a></li>
                  <li><a class="fa fa-pinterest-p" href="https://www.pinterest.com/themefisher" target="_blank"></a></li>
                  <li><a class="fa fa-vimeo" href=""></a></li>
                </ul>
              </div>
            </div>
          </div>
 
          <div class="top-to">
            <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
          </div>
        </footer>
        
        <!-- JAVASCRIPTS -->
        <script src="{$this->container->router->pathFor("home")}plugins/jQuery/jquery.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/bootstrap/js/popper.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/bootstrap/js/bootstrap-slider.js"></script>
          <!-- tether js -->
        <script src="{$this->container->router->pathFor("home")}plugins/tether/js/tether.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/raty/jquery.raty-fa.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/slick-carousel/slick/slick.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/smoothscroll/SmoothScroll.min.js"></script>
        <!-- google map -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
        <script src="{$this->container->router->pathFor("home")}plugins/google-map/gmap.js"></script>
        <script src="{$this->container->router->pathFor("home")}js/script.js"></script>
        
        </body>
        </html> 
END;
    }

    /**
     * Méthode pour afficher la page d'accueil
     * Utilisé par la fonction 0, route racine de l'accueil
     * @return string String: contenu html
     * @author Lucas Weiss
     */
    public function affichageAccueil(): string
    {

        $html = <<<END
                   
                        <h2 class="text-info">Bienvenue</h2>
END;


        return $html;
    }

}