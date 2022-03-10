<?php

namespace CustomBox\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'mpd'
    ];

    public function removeAccount(){

        $this->delete();

    }

    public function commandes() {
        return $this->hasMany('\CustomBox\Models\Commande', 'idUser');
    }

}
