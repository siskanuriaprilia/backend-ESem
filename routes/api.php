<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendanceController;

Route::get('/', function() {
    return 'Laravel is running!';
});

Route::post('/register', [AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'Login']);

Route::get('/events',[EventController::class,'getEvent']);
Route::get('/eventDetail/{id}',[EventController::class,'getDetail']);
Route::post('/Scan', [AttendanceController::class, 'scan']);

Route::post('/event/create', [EventController::class, 'createEvent']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'User']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'Me']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
});