<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sucursalle extends Model
{
       protected $fillable = [
        'name',
        'adresse',
        'ville',
        'pays',
        'phone',
        'email',
        'statut'
        
    ];

    protected
 $primaryKey = 'sucursalle_id';
 public $incrementing = true;
protected $keyType = 'int';
}
