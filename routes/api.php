<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controladores
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VehiculoController;


//Api Usuario
Route::get('/usuario',[UsuarioController::class,'index']);

Route::get('/usuario/{id}',[UsuarioController::class,'show']);

Route::post('/usuario', [UsuarioController::class,'store']);

Route::put('/usuario/{id}',[UsuarioController::class,'update']);

Route::delete('/usuario/{id}',[UsuarioController::class,'destroy']);


// API Vehiculo
Route::get('/vehiculo', [VehiculoController::class, 'index']);
Route::get('/vehiculo/{id}', [VehiculoController::class, 'show']);
Route::post('/vehiculo', [VehiculoController::class, 'store']);
Route::put('/vehiculo/{id}', [VehiculoController::class, 'update']);
Route::delete('/vehiculo/{id}', [VehiculoController::class, 'destroy']);