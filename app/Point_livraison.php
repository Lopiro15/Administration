<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point_livraison extends Model
{
    protected $fillable = ['nom_point', 'description', 'prix', 'ville'];
}
