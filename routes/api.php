<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesztController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("register", [AuthController::class, "register"]); 
Route::post("login", [AuthController::class, "login"]); 




Route::middleware('auth:sanctum', 'isAPIAdmin')->group(function () {    


Route::get('/checkAuthWithAPI', function(){

	return response()->json(['message'=> 'You are in', 'status' => 200], 200);

});



Route::get('view-category',[CategoryController::class, 'index']);		
Route::post('add-category',[CategoryController::class, 'store']);	
Route::get('edit-category/{id}',[CategoryController::class, 'edit']);
Route::put('update-category/{id}',[CategoryController::class, 'update']);


});


Route::middleware('auth:sanctum')->group(function () {


    
Route::post("logout", [AuthController::class, "logout"]); 


});


