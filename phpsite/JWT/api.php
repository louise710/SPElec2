<?php
use App\JWTAuth\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->get('/user', [AuthController::class, 'getUser']);
