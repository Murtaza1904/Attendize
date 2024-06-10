<?php

use App\Http\Controllers\API\AttendeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsApiController;
use App\Http\Controllers\API\AttendeesApiController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\LoginController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events', EventsApiController::class);

Route::resource('attendees', AttendeesApiController::class);

// Login
Route::post('login', LoginController::class);

// Route::middleware('auth:sanctum')->group(function () {
    // Events
    Route::get('events-list', EventController::class);
    
    // Attendees
    Route::get('attendees-list', AttendeeController::class);
// });