<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LogUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\UpdateUserRequest;
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
             
                $redirect = $user->profil === 'admin'
                ? '/admin/dashboard'
                : '/user/dashboard';

                // Si profil = user, on récupère la sucursalle liée par la clé
            $sucursalle = null;
            if($user->profil === 'user') {
                $sucursalle = \App\Models\Sucursalle::where('key', $user->key)->first();
            }

                return response()->json([
                       
                        "status_code" => "200",
                        "status_message" => "Utilisateur connecté.",
                        "user"=> $user,
                        "token" => $token,
                        "redirect"=> $redirect,
                         "sucursalle" => $sucursalle // null si admin, objet si user
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



public function update(UpdateUserRequest $request, $id){
 
    $user = new User()::find($id);
    
    $user->name = request('name');
     $user->email = request('email');
     $user->profil = request('profil');
     $user->adresse = request('adresse');
     $user->phone = request('phone');
     $user->password = bcrypt($request->password) ;

     if($user->user_id === auth()->user()->user_id) {

         $user->save();
     return response()->json([
        'message'=> 'modification effectuer',
        'data' => $user,
        ]);

     } else {
 return response()->json([
        'message'=> 'vous ne ne pouvez pas effectuer ces modifications',
         ]);
     }
}

public function delete($id)    {
       try {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }
        $user->delete();
        return response()->json([
            'status_code'=> 200,
            'message'=> 'Utilisateur supprimé avec succès',
            'data' => $user,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
   
      
    }
}
