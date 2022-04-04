<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\TasksController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    
});

Route::group(['prefix'=>'task' ,'middleware' => 'jwtAuth'],function(){
  Route::get('/all',[TasksController::class,'index']);
  Route::get('/details/{id}',[TasksController::class,'taskDetails']);
  Route::post('/create',[TasksController::class,'create']);
  Route::post('/update/{id}',[TasksController::class,'update']);
  Route::post('/delete/{id}',[TasksController::class,'delete']);
});
    