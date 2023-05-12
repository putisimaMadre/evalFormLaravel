<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AlumnoController;
use \App\Http\Controllers\AsignaturaController;
use \App\Http\Controllers\RasgoController;

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

Route::resource('alumnos', AlumnoController::class);
Route::resource('asignatura', AsignaturaController::class);
Route::resource('rasgo', RasgoController::class);
