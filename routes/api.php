<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\PublicacionesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// API's de autentificacion
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


// APIs de pagina principal
Route::resource('/home', PublicacionesController::class)
->middleware(['auth:sanctum','verified'])
->names('admin.home');

Route::get('/get-publicaciones', [PublicacionesController::class, 'getPublicaciones'])
->middleware(['auth:sanctum','verified'])
->name('admin.get-publicaciones');

// APIs de comentarios
Route::resource('/comentario', ComentariosController::class)
->middleware(['auth:sanctum','verified'])
->names('admin.comentario');

Route::get('/get-comentarios/{pub_id}', [ComentariosController::class, 'getComentarios'])
->middleware(['auth:sanctum','verified'])
->name('admin.get-comentarios');