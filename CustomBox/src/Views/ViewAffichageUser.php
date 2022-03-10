<?php

namespace CustomBox\Views;

use Slim\Container;

use CustomBox\Models\User;

class ViewAffichageUser
{

    // ATTRIBUTS
    private $container;

    // CONSTRUCTEUR
    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function affichageUser(): string
    {
        $content ="";

        if(isset($_SESSION['user'])) {
            $admin = User::where('id', $_SESSION['user'])->first();
            if ($admin->admin == 1) {
                $users  = User::query()->select('*')->get();
                $count=1;
                foreach ($users as $user){
                    $content .= <<<END
                    <tr>
                      <th scope="row">$count</th>
                      <td>$user->email</td>
                    </tr>
                    END;
                    $count++;
                }

            }
        }

        $html = <<<END
                
                <div class="m-auto">
                <div class="div-panier"><div class="panier-titre"><h3 class="text-center">La liste de tous les utilisateurs du site :</h3></div></div>
                   <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Email</th>
                        </tr>
                      </thead>
                      <tbody>
                            $content
                       </tbody>
                    </table>
                </div>

        END;

        return $html;

    }
}

