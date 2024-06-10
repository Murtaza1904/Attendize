<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsApiController;
use App\Http\Controllers\API\AttendeesApiController;
use App\Http\Controllers\Api\LoginController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events', EventsApiController::class);

Route::resource('attendees', AttendeesApiController::class);

Route::post('login', LoginController::class);