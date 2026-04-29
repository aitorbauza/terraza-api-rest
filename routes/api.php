<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Endpoints públics (sense autenticació)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/zones', [ZoneController::class, 'index']);
Route::get('/zones/{id}/availability', [ZoneController::class, 'availability']);

// Endpoints privats (requereixen token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/my-reservations', [ReservationController::class, 'myReservations']);
    Route::post('/logout', [AuthController::class, 'logout']);
});