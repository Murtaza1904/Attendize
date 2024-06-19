<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name.' '. $this->last_name,
            'reference' => $this->getReferenceAttribute(),
            'ticket' => $this->ticket->title,
            'has_arrived' => $this->has_arrived === 0 ? false : true,
        ];
    }
}
