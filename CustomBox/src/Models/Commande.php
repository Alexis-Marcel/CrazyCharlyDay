<?php
declare(strict_types=1);

// NAMESPACE
namespace CustomBox\Models;

/**
 * Classe Commande
 * Représente une commande au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Commande extends \Illuminate\Database\Eloquent\Model
{

    // ATTRIBUTS

    public $timestamps = false;
    protected $table = 'commande';
    protected $primaryKey = 'id';


    // CONSTRUCTEUR

    public function user() {
        return $this->belongsTo('\CustomBox\Models\User', 'idUser');
    }

    // METHODES

    public function boite() {
        return $this->belongsTo('\CustomBox\Models\Boite', 'idBoite');
    }

    public function produits() {
        return $this->belongsToMany('\CustomBox\Models\Produit', 'produitCommande', 'idCommande', 'idProduit');
    }

}
