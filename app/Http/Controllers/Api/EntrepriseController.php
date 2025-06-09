<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\createEntrepriseRequest;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\admin;
use Laravel\Sanctum\PersonalAccessToken;

class EntrepriseController
{
    public function register(createEntrepriseRequest $request)
    {
          //recuperer id de l'admin connecter
        $accessToken = request()->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        $admin = null;
        if ($token && $token->tokenable_type === admin::class) {
            $admin = admin::find($token->tokenable_id);
        }

          try{
            if ($admin) {

        $entreprise = new Entreprise();

        $entreprise->name = $request->name;
        $entreprise->email = $request->email;
        $entreprise->slogan = $request->slogan;
        $entreprise->adresse = $request->adresse;
        $entreprise->phone = $request->phone;
        $entreprise->ville = $request->ville;
        $entreprise->pays = $request->pays;
        $entreprise->site_web = $request->site_web;
        $entreprise->logo = $request->logo;
        $entreprise->raison_sociale = $request->raison_sociale;
        $entreprise->registre_de_commerce = $request->registre_de_commerce;
         $entreprise->id_fiscal = $request->id_fiscal;
         $entreprise->description = $request->description;
         $entreprise->rccm = $request->rccm;
         $entreprise->niu = $request->niu;

        $entreprise->admin_id = $admin->admin_id; 
        $entreprise->save();

         return response()->json([
        'status_code'=> '200',
        'status_message' => 'Entreprise créer avec succès',
        'entreprise'=> $entreprise
      
       ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "error"=> $e->getMessage()
                ],401);
        }
    }
}
