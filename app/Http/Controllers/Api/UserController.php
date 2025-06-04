<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LogUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Models\User;

class UserController
{
    public function register(UserRequest $request){
        try{

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profil = $request->profil;
        $user->adresse = $request->adresse;
        $user->phone = $request->phone;
        $user->key = $request->key;
        $user->password = bcrypt($request->password);
        $user->save();

         return response()->json([
        'status_code'=> '200',
        'status_message' => 'Utilisateur enregistrer avec succès',
        'user'=> $user
      
       ]);

        }catch(\Exception $e){
            return response()->json([
                "error"=> $e->getMessage()
                ],0);
        }
       
    }



    public function login(LogUserRequest $request){
        try{
              //verifier si l'utilisateur existe et que le mot de passe est correct
            if(auth('web')->attempt($request->only(["email","password"]))){
              // si l'utilisateur existe, on le recupere
                $user = auth('web')->user();
              //  dd($user) ;
              //  on creer un token pour l'utilisateur pour les futures requetes
                $token = $user->createToken("MA_CLEE_SECRETE_VISIBLE_AU_BACKEND")->plainTextToken;
             
                return response()->json([
                       
                        "status_code" => "200",
                        "status_message" => "Utilisateur connecté.",
                        "user"=> $user,
                        "token" => $token
                        ],200);

                         
                }else{
                    return response()->json([
                        "error"=> "true",
                        "status_code" => "403",
                        "status_message" => "Les informations founis sont incorrtes."

                        ]);
                }
        
        }catch(\Exception $e){
            return response()->json([
                "error"=> $e->getMessage()
                ],500);
            }
        }



public function Edit(UserRequest $request, $id){
 
    $user = new User();
    $user->name = request('name');
     $user->email = request('email');
     $user->profil = request('profil');
     $user->adresse = request('adresse');
     $user->phone = request('phone');
     $user->password = bcrypt($request->password) ;

     if($user->user_id === auth()->user()->id) {

         $user->save();
     return response()->json([
        'message'=> 'modification effectuer',
        'data' => $user,
        ]);

     } else {
 return response()->json([
        'message'=> 'vous n etes pas l auteur de ce post',
         ]);
     }
}
   
}
