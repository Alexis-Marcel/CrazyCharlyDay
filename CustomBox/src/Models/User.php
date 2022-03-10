<?php

namespace CustomBox\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    // ATTRIBUTS

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // CONSTRUCTEUR

    protected $fillable = [
        'email',
        'mpd'
    ];

    // METHODES

    public function removeAccount(){
        $this->delete();
    }

    public function commandes() {
        return $this->hasMany('\CustomBox\Models\Commande', 'idUser');
    }

    public function avis()
    {
        return $this->hasMany('\CustomBox\Models\Avis', 'auteur');
    }

}
