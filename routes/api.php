<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
// use App\Http\Controllers\UserController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Api\postController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;







//enregistrer un utilisateur
Route::post('/register', [UserController::class,'register']);

//connexion d'un utilisateur
Route::post('/login', [UserController::class,'login']);



Route::middleware('auth:sanctum')->group( function ()
{
   
Route::put('/user/edit/{id}', [UserController::class,'Edit']);

 Route::get('/user', function(Request $request){
    return $request->user();
 } );
});