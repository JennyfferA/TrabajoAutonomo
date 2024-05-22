<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VehiculoController;
use App\Http\Controllers\Api\EspacioController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\IngresoController;
use App\Http\Controllers\Api\SalidaController;
use App\Http\Controllers\AuthController;

// Rutas de autenticación
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

// Rutas API protegidas
Route::group(['middleware' => ['api', 'auth:api']], function () {
    // API Usuario
    Route::apiResource('usuarios', UsuarioController::class);

    // API Vehiculo
    Route::apiResource('vehiculo', VehiculoController::class);

    // API Espacio
    Route::apiResource('espacios', EspacioController::class);

    // API Reserva
    Route::apiResource('reservas', ReservaController::class);

    // API Ingreso
    Route::apiResource('ingresos', IngresoController::class);

    // API Salida
    Route::apiResource('salidas', SalidaController::class);
});