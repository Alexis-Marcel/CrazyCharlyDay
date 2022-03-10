<?php
declare(strict_types=1);

namespace CustomBox\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie(){
        return $this->belongsTo('\CustomBox\Models\Categorie','categorie');
    }

    public function commandes() {
        return $this->belongsToMany('\CustomBox\Models\Commande', 'produitCommande', 'idProduit', 'idCommande');
    }

    public function avis()
    {
        return $this->hasMany('\CustomBox\Models\Avis', 'idProduit');
    }


}
