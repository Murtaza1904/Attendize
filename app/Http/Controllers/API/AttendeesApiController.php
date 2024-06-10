<?php

namespace App\Http\Controllers\API;

use App\Models\Attendee;

class AttendeesApiController extends ApiBaseController
{
    public function index()
    {
        return Attendee::get();
    }
}
