<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use App\Http\Controllers\API\ApiBaseController;

class EventsApiController extends ApiBaseController
{
    public function index()
    {
        return Event::orderBy('start_date')->get();
    }
}
