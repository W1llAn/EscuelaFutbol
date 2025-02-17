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


Route::get('/Escuela/horarios', [EscuelaController::class, 'horarios']);
Route::delete("/Escuela/horarios/{id} {horario}", [EscuelaController::class, 'destroy']);
Route::put("/Escuela/horarios/{id} {horario} /edit", [EscuelaController::class, 'update']);

//rutas para categorias
Route::get('/Escuela/categorias', [EscuelaController::class, 'categorias'])->name('categorias');
Route::get('/Escuela/categorias/create', [EscuelaController::class, 'crearCategoria'])->name('crearCategoria');
Route::post('/Escuela/categorias', [EscuelaController::class, 'guardarCategoria'])->name('guardarCategoria');
Route::get('/Escuela/categorias/{id}/edit', [EscuelaController::class, 'editarCategoria'])->name('editarCategoria');
Route::put('/Escuela/categorias/{id}', [EscuelaController::class, 'actualizarCategoria'])->name('actualizarCategoria');
Route::post('/Escuela/categorias/asignar', [EscuelaController::class, 'asignarJugadorACategoria'])->name('asignarJugadorACategoria');
Route::delete('/Escuela/categorias/{id}', [EscuelaController::class, 'eliminarCategoria'])->name('eliminarCategoria');

//rutas para entrenadores
Route::get('/Escuela/entrenadores', [EscuelaController::class, 'entrenadores'])->name('entrenadores');
Route::get('/Escuela/entrenadores/create', [EscuelaController::class, 'crearEntrenador'])->name('crearEntrenador');
Route::post('/Escuela/entrenadores', [EscuelaController::class, 'guardarEntrenador'])->name('guardarEntrenador');
Route::delete('/Escuela/entrenadores/{id}', [EscuelaController::class, 'eliminarEntrenador'])->name('eliminarEntrenador');
Route::put('/Escuela/entrenadores/{id}', [EscuelaController::class, 'actualizarEntrenador'])->name('actualizarEntrenador');

