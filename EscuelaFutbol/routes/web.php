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
