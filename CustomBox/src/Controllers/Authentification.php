<?php

namespace CustomBox\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use CustomBox\Models\User;
use CustomBox\Views\ViewSign;

class Authentification extends Controller
{

    public function getSignIn(Request $request, Response $response)
    {
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->signin());
        return $response;
    }

    public function postSignIn(Request $request,Response $response)
    {
        $email = filter_var($request->getParam('email'), FILTER_SANITIZE_STRING) ;
        $password = filter_var($request->getParam('pass'), FILTER_SANITIZE_STRING) ;
        $re_password = filter_var($request->getParam('re_pass'), FILTER_SANITIZE_STRING) ;

        if(!$this->check($email,$password,$re_password)){
            return $response->withRedirect($this->container->router->pathFor('signin'));
        }

        $user = User::create([
            'email' => $email,
            'mpd' => password_hash($password,PASSWORD_DEFAULT),
        ]);

        $this->attempt($email,$password);

        return $response->withRedirect($this->container->router->pathFor('home'));
    }

    public function check($email,$password,$re_password){
        $valide = true;

        if($password !== $re_password){
            $valide = false;
        }
        else if(User::where('email', $email)->count() !== 0){
            $valide = false;
        }

        return $valide;

    }

    public function getSignOut(Request $request, Response $response){

        unset($_SESSION['user']);

        return $response->withRedirect($this->container->router->pathFor('home'));

    }

    public function getSignUp(Request $request, Response $response)
    {
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->signup());
        return $response;
    }

    public function postSignUp(Request $request,Response $response)
    {
        $email = filter_var($request->getParam('email'), FILTER_SANITIZE_STRING) ;
        $password = filter_var($request->getParam('pass'), FILTER_SANITIZE_STRING) ;

        $auth = $this->attempt($email,$password);

        if(!$auth){
            return $response->withRedirect($this->container->router->pathFor('signup'));
        }

        return $response->withRedirect($this->container->router->pathFor('home'));
    }

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

    public function getEditCompte(Request $request, Response $response){
        $vueSignIn = new ViewSign($this->container);
        $response->getBody()->write($vueSignIn->editCompte());
        return $response;
    }

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
                    return $response->withRedirect($this->container->router->pathFor('editCompte'));
                }
            }
            else {
                echo $ancienpass;
            }
        }
        else {
            return $response->withRedirect($this->container->router->pathFor('home'));
        }





    }
}