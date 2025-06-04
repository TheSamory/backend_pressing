<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\createSucursalleRequest;
use Illuminate\Http\Request;
use App\Models\Sucursalle;

class SucursalleController
{
    public function register(createSucursalleRequest $request)
    {
        try {
        $sucursalle = new Sucursalle();

        $sucursalle->name = $request->name;
        $sucursalle->email = $request->email;
        $sucursalle->phone = $request->phone;
        $sucursalle->adresse = $request->adresse;
        $sucursalle->ville = $request->pays;
        $sucursalle->pays = $request->pays;
        $sucursalle->statut = $request->statut;
        $sucursalle->key = $request->key;
        $sucursalle->user_id = auth()->user()->user_id;

        $sucursalle->save();

        return response()->json([
        'status_code'=> '200',
        'status_message' => 'Sucursalle créer avec succès',
        'sucursalle'=> $sucursalle
      
       ]);

        }catch(\Exception $e){
            return response()->json([
                "error"=> $e->getMessage()
                ],401);
        }


    }
}
