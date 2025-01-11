<?php

use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Route;

Route::get('/inicio', function () {
    return view('welcome');
});
Route::get('/Escuela/create',[EscuelaController::class,'create']);
Route::get('/Escuela',[EscuelaController::class,'index']);
