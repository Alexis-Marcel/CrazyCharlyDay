<?php

namespace CustomBox\Views;

use CustomBox\Views\ViewRender;
use Slim\Container;

use CustomBox\Models\User;

class ViewSign
{

    // ATTRIBUTS
    private $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function signin(): string
    {
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Sign In CustomBox</title>
            
                <!-- Font Icon -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/fonts/material-icon/css/material-design-iconic-font.min.css">
            
                <!-- Main css -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/css/sign.css">
            </head>
            <body>
            
                <div class="main">
            
                    <!-- Sign up form -->
                    <section class="signup">
                        <div class="container">
                            <div class="signup-content">
                                <div class="signup-form">
                                    <h2 class="form-title">Inscription</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("signin")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                                            <input type="email" name="email" id="email" placeholder="Votre Email" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                            <input type="password" name="pass" id="pass" placeholder="Mot de passe" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                            <input type="password" name="re_pass" id="re_pass" placeholder="Répétez votre mot de passe" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                        </div>
                                        <div class="form-group form-button">
                                            <input type="submit" name="signup" id="signup" class="form-submit" value="Inscription"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-image">
                                    <figure><img src="{$this->container->router->pathFor("home")}assets/images/sign/signup-image.jpg" alt="sing up image"></figure>
                                    <a href="{$this->container->router->pathFor("signup")}" class="signup-image-link">J'ai déjà un compte</a>
                                </div>
                            </div>
                        </div>
                    </section>
           
            
                </div>
            
            </body>
            </html>
        END;

        return $html;

    }

    public function signup(): string
    {
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Sign In CustomBox</title>
            
                <!-- Font Icon -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/fonts/material-icon/css/material-design-iconic-font.min.css">
            
                <!-- Main css -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/css/sign.css">
            </head>
            <body>
            
                <div class="main">
            
                    <!-- Sign up form -->
                    <section class="signup">
                        <div class="container">
                            <div class="signup-content">
                                <div class="signup-form">
                                    <h2 class="form-title">Connexion</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("signup")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                                            <input type="email" name="email" id="email" placeholder="Votre Email" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                            <input type="password" name="pass" id="pass" placeholder="Mot de passe" required />
                                        </div>
                                        <div class="form-group form-button">
                                            <input type="submit" name="signup" id="signup" class="form-submit" value="Connexion"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-image">
                                    <figure><img src="{$this->container->router->pathFor("home")}assets/images/sign/signup-image.jpg" alt="sing up image"></figure>
                                    <a href="{$this->container->router->pathFor("signin")}" class="signup-image-link">Je n'ai pas encore de compte</a>
                                </div>
                            </div>
                        </div>
                    </section>
           
            
                </div>
            
            </body>
            </html>
        END;

        return $html;

    }

    public function editCompte(): string
    {
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Mon profil</title>
            
                <!-- Font Icon -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/fonts/material-icon/css/material-design-iconic-font.min.css">
            
                <!-- Main css -->
                <link rel="stylesheet" href="{$this->container->router->pathFor("home")}assets/css/sign.css">
            </head>
            <body>
            
                <div class="main">
            
                    <!-- Sign up form -->
                    <section class="signup">
                        <div class="container">
                            <div class="signup-content">
                                <div class="signup-form">
                                    <h2 class="form-title">Mon profil</h2>
                                    <form method="POST" action="{$this->container->router->pathFor("editCompte")}" class="register-form" id="register-form">
                                        <div class="form-group">
                                            <label for="ancienmdp"><i class="zmdi zmdi-email"></i></label>
                                            <input type="password" name="ancienmdp" id="ancienmdp" placeholder="Ancien mot de passe" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="nouveaumdp"><i class="zmdi zmdi-lock"></i></label>
                                            <input type="password" name="nouveaumdp" id="nouveaumdp" placeholder="Nouveau mot de passe" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="re_nouveaumdp"><i class="zmdi zmdi-lock"></i></label>
                                            <input type="password" name="re_nouveaumdp" id="re_nouveaumdp" placeholder="Répétez votre nouveau mot de passe" required />
                                        </div>
                                        <div class="form-group form-button">
                                            <input type="submit" name="signup" id="signup" class="form-submit" value="Changer le mot de passe"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-image">
                                    <figure><img src="{$this->container->router->pathFor("home")}assets/images/sign/signup-image.jpg" alt="sing up image"></figure>
                                </div>
                            </div>
                        </div>
                    </section>
           
            
                </div>
            
            </body>
            </html>
        END;

        return $html;

    }
}

