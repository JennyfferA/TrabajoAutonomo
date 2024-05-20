<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controladores
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VehiculoController;
use App\Http\Controllers\Api\EspacioController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\IngresoController;
use App\Http\Controllers\Api\SalidaController;



//Api Usuario
Route::get('/listar-usuario',[UsuarioController::class,'index']);

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


// Api Espacio
Route::get('espacios', [EspacioController::class ,'index']);
Route::get('/espacio/{id}', [EspacioController::class, 'show']);
Route::post('/espacio', [EspacioController::class, 'store']);
Route::put('/espacio/{id}', [EspacioController::class, 'update']);
Route::delete('/espacio/{id}', [EspacioController::class, 'destroy']);


//Api Reserva
Route::get('reservas', [ReservaController::class ,'index']);
Route::get('/reserva/{id}', [ReservaController::class, 'show']);
Route::post('/reserva', [ReservaController::class, 'store']);
Route::put('/reserva/{id}', [ReservaController::class, 'update']);
Route::delete('/reserva/{id}', [ReservaController::class, 'destroy']);

//Api Ingreso
Route::get('ingresos', [IngresoController::class ,'index']);
Route::get('/ingreso/{id}', [IngresoController::class, 'show']);
Route::post('/ingreso', [IngresoController::class, 'store']);
Route::put('/ingreso/{id}', [IngresoController::class, 'update']);
Route::delete('/ingreso/{id}', [IngresoController::class, 'destroy']);

//Api Salida
Route::get('salidas', [SalidaController::class ,'index']);
Route::get('/salida/{id}', [SalidaController::class, 'show']);
Route::post('/salida', [SalidaController::class, 'store']);
Route::put('/salida/{id}', [SalidaController::class, 'update']);
Route::delete('/salida/{id}', [SalidaController::class, 'destroy']);