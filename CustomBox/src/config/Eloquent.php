<?php

namespace CustomBox\config;

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Classe Eloquent qui lance toute la partie Eloquent du projet
 */
class Eloquent{

    /**
     * Methode de lancement d'Eloquent
     */
    public static function start(string $file)
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($file));
        $db->setAsGlobal();
        $db->bootEloquent();
    }


}