<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $allowed_sorts = ['created_at', 'start_date', 'end_date', 'title'];

        $sort_by = (in_array($request->get('sort_by'), $allowed_sorts) ? $request->get('sort_by') : 'start_date');

        return response()->json([
            'events' => EventResource::collection(Event::orderBy($sort_by, 'desc')->get()), 
        ]);
    }
}
