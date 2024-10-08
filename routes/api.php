<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    // http://127.0.0.1/api/protected
    Route::get('/protected', function () {
        return 'Protected resource';
    });
});
// http://127.0.0.1/api/unprotected
Route::get('/unprotected', function () {
    return 'Unprotected resource';
});
