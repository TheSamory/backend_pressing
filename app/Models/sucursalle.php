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
        'statut',
        'key',
        'user_id',
        
    ];
}
