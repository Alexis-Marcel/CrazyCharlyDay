<?php
declare(strict_types=1);

namespace CustomBox\Models;

use Illuminate\Database\Eloquent\Model;

class Boite extends Model
{
    protected $table = 'boite';
    protected $primaryKey = 'id';
    public $timestamps = false;

}