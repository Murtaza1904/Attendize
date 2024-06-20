<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\AttendeeController;
use App\Http\Controllers\API\EventsApiController;
use App\Http\Controllers\API\AttendeesApiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events', EventsApiController::class);

Route::resource('attendees', AttendeesApiController::class);

// Login
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Events
    Route::get('events-list', [EventController::class, 'index']);
    
    // Attendees
    Route::get('attendees-list/{event}', [AttendeeController::class, 'index']);
    Route::put('attendees-list/{event}/check-mark', [AttendeeController::class, 'update']);
    Route::put('attendees-list/{event}/check-mark-qrcode', [AttendeeController::class, 'updateUsingQrcode']);

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);
});