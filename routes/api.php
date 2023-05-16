<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AlumnoController;
use \App\Http\Controllers\AsignaturaController;
use \App\Http\Controllers\RasgoController;
use \App\Http\Controllers\ActividadController;
use \App\Http\Controllers\CalificacionController;

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
Route::controller(RasgoController::class)->group(function(){
    Route::resource('rasgo', RasgoController::class);
    Route::post('rasgoResumen', 'rasgoResumen');
    Route::post('getGrafico', 'getGrafico');
});
Route::resource('actividad', ActividadController::class);
Route::resource('calificacion', CalificacionController::class);

