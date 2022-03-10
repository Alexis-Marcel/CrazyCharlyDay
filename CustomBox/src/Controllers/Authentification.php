<?php

namespace CustomBox\Controllers;

use CustomBox\Views\ViewRender;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Models\User;
use CustomBox\Views\ViewSign;

/**
 * Classe qui gère l'authentification et les comptes
 */
class Authentification extends Controller
{

    /**
     * Fonction get qui affiche la page pour s'identifier
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getSignIn(Request $request, Response $response)
    {
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->signin());
        return $response;
    }

    /**
     * Fonction post pour s'identifier
     * @param Request $request
     * @param Response $response
     * @return Response|\Slim\Http\Response
     */
    public function postSignIn(Request $request,Response $response)
    {
        $email = filter_var($request->getParam('email'), FILTER_SANITIZE_STRING) ;
        $password = filter_var($request->getParam('pass'), FILTER_SANITIZE_STRING) ;
        $re_password = filter_var($request->getParam('re_pass'), FILTER_SANITIZE_STRING) ;

        if(!$this->checkMp($password,$re_password)){
            $vue = new ViewRender($this->container);
            return $response->getBody()->write($vue->afficherErreur("Les mots de passe ne sont pas identiques !"));
        }

        if(!$this->checkEmail($email)){
            $vue = new ViewRender($this->container);
            return $response->getBody()->write($vue->afficherErreur("Cet email est déjà utilisé !"));
        }

        $user = User::create([
            'email' => $email,
            'mpd' => password_hash($password,PASSWORD_DEFAULT),
        ]);

        $this->attempt($email,$password);

        return $response->withRedirect($this->container->router->pathFor('home'));
    }

    /**
     * Fonctionnalite qui verifie que les deux mdp donnés en parametre sont identiques
     * @param $password
     * @param $re_password
     * @return bool
     */
    public function checkMp($password,$re_password){
        $valide = true;

        if($password !== $re_password){
            $valide = false;
        }


        return $valide;

    }

    /**
     * Fonctionnalité qui verifie l'email donné en parametre
     * @param $email
     * @return bool
     */
    public function checkEmail($email){
        $valide = true;
         if(User::where('email', $email)->count() !== 0){
            $valide = false;
        }

        return $valide;
    }

    /**
     * Fonction get pour se deconnecter
     * @param Request $request
     * @param Response $response
     * @return Response|\Slim\Http\Response
     */
    public function getSignOut(Request $request, Response $response){

        unset($_SESSION['user']);

        return $response->withRedirect($this->container->router->pathFor('home'));

    }

    /**
     * Fonction get pour afficher la page d'inscription
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getSignUp(Request $request, Response $response)
    {
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->signup());
        return $response;
    }

    /**
     * Fonction post pour effectuer l'inscription d'un user
     * @param Request $request
     * @param Response $response
     * @return int|Response|\Slim\Http\Response
     */
    public function postSignUp(Request $request,Response $response)
    {
        $email = filter_var($request->getParam('email'), FILTER_SANITIZE_STRING) ;
        $password = filter_var($request->getParam('pass'), FILTER_SANITIZE_STRING) ;

        $auth = $this->attempt($email,$password);

        if(!$auth){
                $vue = new ViewRender($this->container);
                return $response->getBody()->write($vue->afficherErreur("L'email ou le mot de passe est incorrect"));
        }

        return $response->withRedirect($this->container->router->pathFor('home'));
    }

    /**
     * Fonctionnalité qui verifie la connection
     * @param $email
     * @param $password
     * @return bool|void
     */
    public function attempt($email,$password){

        $user = User::where('email', $email)->first();

        if(!$user) {
            return false;
        }

        if(password_verify($password, $user->mpd)) {
            $_SESSION['user'] = $user->id;
            return true;
        }
    }

    /**
     * Fonction get qui affiche la page html pour editer son compte user
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getEditCompte(Request $request, Response $response){
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->editCompte());
        return $response;
    }

    /**
     * Fonction post qui effctue la modification de compte
     * @param Request $request
     * @param Response $response
     * @return int|Response|\Slim\Http\Response
     */
    public function postEditCompte(Request $request, Response $response){

        $ancienpass = filter_var($request->getParam('ancienmdp'), FILTER_SANITIZE_STRING) ;
        $nvpass = filter_var($request->getParam('nouveaumdp'), FILTER_SANITIZE_STRING) ;
        $re_nvpass = filter_var($request->getParam('re_nouveaumdp'), FILTER_SANITIZE_STRING) ;

        if(isset($_SESSION['user'])){
            $user = User::where('id', $_SESSION['user'])->first();

            if(password_verify($ancienpass, $user->mpd)) {

                if($nvpass === $re_nvpass){
                    $user->update([
                        'mpd' => password_hash($nvpass,PASSWORD_DEFAULT)
                    ]);
                    return $response->withRedirect($this->container->router->pathFor('home'));

                }
                else {
                        $vue = new ViewRender($this->container);
                        return $response->getBody()->write($vue->afficherErreur("Les mots de passe ne sont pas identiques !"));
                }
            }
            else {
                $vue = new ViewRender($this->container);
                return $response->getBody()->write($vue->afficherErreur("Ancien mot de passe incorrect !"));
            }
        }
        else {
            return $response->withRedirect($this->container->router->pathFor('home'));
        }





    }
}