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
Route::get('/Escuela/categorias', [EscuelaController::class, 'categorias'])->name('categorias.index');
Route::get('/Escuela/categorias/create', [EscuelaController::class, 'crearCategoria'])->name('categorias.create');
Route::get('/Escuela/categorias/{id}/edit', [EscuelaController::class, 'editarCategoria'])->name('categorias.edit');
Route::put('/Escuela/categorias/{id}', [EscuelaController::class, 'updateCategoria'])->name('categorias.update');
Route::delete('/Escuela/categorias/{id}', [EscuelaController::class, 'destroyCategoria'])->name('categorias.destroy');