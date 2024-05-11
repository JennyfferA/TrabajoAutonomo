<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarioController;

Route::get('/usuario',[UsuarioController::class,'index']);

Route::get('/usuario/{id}',[UsuarioController::class,'show']);

Route::post('/usuario', [UsuarioController::class,'store']);

Route::put('/usuario/{id}',[UsuarioController::class,'update']);

Route::delete('/usuario/{id}',[UsuarioController::class,'destroy']);

