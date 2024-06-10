<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsApiController;
use App\Http\Controllers\API\AttendeesApiController;

// Events
Route::get('events', [EventsApiController::class, 'index']);

// Attendees
Route::get('attendees', [AttendeesApiController::class, 'index']);
