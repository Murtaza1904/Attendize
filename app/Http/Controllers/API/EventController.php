<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'events1' => EventResource::collection(Event::orderBy('start_date')->get()), 
        ]);
    }
}
