<?php

use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Route;

Route::get('/inicio', function () {
    return view('welcome');
});
Route::get('Escuela',[EscuelaController::class,'index']);
Route::get('Escuela/InscripcionesYpagos',[EscuelaController::class,'InscripcionesYpagos']);
Route::get('Escuela/InscripcionesYpagos/Inscripciones',[EscuelaController::class,'Inscripciones']);

Route::get('Escuela/InscripcionesYpagos/{id}/InscripcionesEditar',[EscuelaController::class,'editaEstudiante']);
Route::put('Escuela/InscripcionesYpagos/{id} {actualizarEstudiante}',[EscuelaController::class,'updateEstudiante']);


Route::get('Escuela/InscripcionesYpagos/{id}/Pagos',[EscuelaController::class,'pagos']);
Route::put('Escuela/InscripcionesYpagos/{id} ',[EscuelaController::class,'updatePagos']);


Route::post('Escuela/InscripcionesYpagos',[EscuelaController::class,'guardarInscripcion']);

Route::delete('Escuela/InscripcionesYpagos/{id} {type}',[EscuelaController::class,'eliminarInscripcion']);

Route::get('Escuela/InscripcionesYpagos/{nombre} {type}', [EscuelaController::class,'buscar']);

