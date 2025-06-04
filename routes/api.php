<?php

use App\Http\Controllers\Api\SucursalleController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
// use App\Http\Controllers\UserController;


use App\Http\Controllers\AuthController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EntrepriseController;


use Illuminate\Http\Request;








//enregistrer un utilisateur
Route::post('/register', [UserController::class,'register']);
//connexion d'un utilisateur
Route::post('/login', [UserController::class,'login']);



Route::middleware('auth:sanctum')->group( function ()
{


// api utilisateur 
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('/user/delete/{id}', [UserController::class,'delete']);
Route::get('/user', function(Request $request){
    return $request->user();
});



//api entreprise
Route::post('/create/entreprise', [EntrepriseController::class,'register']);


// api sucursalle
Route::post('/create/sucursalle', [SucursalleController::class, 'register']);
});