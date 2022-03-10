<?php
declare(strict_types=1);

namespace CustomBox\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function auteur(){
        return $this->belongsTo('\CustomBox\Models\User','auteur');
    }

    public function produit(){
        return $this->belongsTo('\CustomBox\Models\Produit','idProduit');
    }


}
