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
            'private_reference' => $this->private_reference_number,
            'ticket' => $this->ticket->title,
            'has_arrived' => $this->has_arrived === 0 ? false : true,
            'number_of_person' => $this->ticket->number_of_person,
        ];
    }
}
