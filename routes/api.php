<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
        // nombre             el controlador   la funcion
// Route::get('post/hola-mundo', 'PostController@holaMundo');
// Route::get('post',PostController::class . '@index');
// Route::post('post',PostController::class . '@store'); 
// Route::get('post/{id}',PostController::class . '@show');
// Route::put('post/{id}',PostController::class . '@update');
// Route::delete('post/{id}',PostController::class . '@delete');
// Route::apiResource('post', 'PostController');
Route::apiResource('post', PostController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// esto se va a otra rama