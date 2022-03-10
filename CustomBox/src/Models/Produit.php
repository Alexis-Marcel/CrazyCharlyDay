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

}
