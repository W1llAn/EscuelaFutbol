<?php

use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/Escuela/create', [EscuelaController::class, 'create']);
Route::get('/Escuela', [EscuelaController::class, 'index']);
Route::get('/Escuela/horarios', [EscuelaController::class, 'horarios']);
Route::delete("/Escuela/horarios/{id} {horario}", [EscuelaController::class, 'destroy']);
Route::put("/Escuela/horarios/{id} {horario} /edit", [EscuelaController::class, 'update']);

//rutas para categorias
Route::get('/Escuela/categorias', [EscuelaController::class, 'categorias'])->name('categorias');
Route::get('/Escuela/categorias/create', [EscuelaController::class, 'crearCategoria'])->name('crearCategoria');
Route::post('/Escuela/categorias', [EscuelaController::class, 'guardarCategoria'])->name('guardarCategoria');
Route::get('/Escuela/categorias/{id}/edit', [EscuelaController::class, 'editarCategoria'])->name('editarCategoria');
Route::put('/Escuela/categorias/{id}', [EscuelaController::class, 'actualizarCategoria']);
Route::delete('/Escuela/categorias/{id}', [EscuelaController::class, 'eliminarCategoria'])->name('eliminarCategoria');
