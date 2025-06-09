<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class entreprise extends Model
{
        protected $fillable = [
        'name',
        'slogan',
        'adresse',
        'ville',
        'pays',
        'phone',
        'email',
        'site_web',
        'logo',
        'raison_sociale',
        'registre_de_commerce',
        'id_fiscal',
        'description',
        'rccm',
        'niu',
        'admin_id',
        
    ];
}
