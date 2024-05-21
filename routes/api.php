<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VehiculoController;
use App\Http\Controllers\Api\EspacioController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\IngresoController;
use App\Http\Controllers\Api\SalidaController;
use App\Http\Middleware\CustomAuthenticate;

use App\Http\Controllers\Api\AuthController;

// Rutas de autenticación
Route::group([
    'middleware' => 'CustomAuthenticate',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// Rutas protegidas por el middleware personalizado
Route::middleware(CustomAuthenticate::class)->group(function () {
    // API Usuario
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
    Route::post('/usuario', [UsuarioController::class, 'store']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);

    // API Vehiculo
    Route::get('/vehiculo', [VehiculoController::class, 'index']);
    Route::get('/vehiculo/{id}', [VehiculoController::class, 'show']);
    Route::post('/vehiculo', [VehiculoController::class, 'store']);
    Route::put('/vehiculo/{id}', [VehiculoController::class, 'update']);
    Route::delete('/vehiculo/{id}', [VehiculoController::class, 'destroy']);

    // API Espacio
    Route::get('espacios', [EspacioController::class, 'index']);
    Route::get('/espacio/{id}', [EspacioController::class, 'show']);
    Route::post('/espacio', [EspacioController::class, 'store']);
    Route::put('/espacio/{id}', [EspacioController::class, 'update']);
    Route::delete('/espacio/{id}', [EspacioController::class, 'destroy']);

    // API Reserva
    Route::get('reservas', [ReservaController::class, 'index']);
    Route::get('/reserva/{id}', [ReservaController::class, 'show']);
    Route::post('/reserva', [ReservaController::class, 'store']);
    Route::put('/reserva/{id}', [ReservaController::class, 'update']);
    Route::delete('/reserva/{id}', [ReservaController::class, 'destroy']);

    // API Ingreso
    Route::get('ingresos', [IngresoController::class, 'index']);
    Route::get('/ingreso/{id}', [IngresoController::class, 'show']);
    Route::post('/ingreso', [IngresoController::class, 'store']);
    Route::put('/ingreso/{id}', [IngresoController::class, 'update']);
    Route::delete('/ingreso/{id}', [IngresoController::class, 'destroy']);

    // API Salida
    Route::get('salidas', [SalidaController::class, 'index']);
    Route::get('/salida/{id}', [SalidaController::class, 'show']);
    Route::post('/salida', [SalidaController::class, 'store']);
    Route::put('/salida/{id}', [SalidaController::class, 'update']);
    Route::delete('/salida/{id}', [SalidaController::class, 'destroy']);
});