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
            'number_of_days' => $this->ticket->number_of_days,
            $this->mergeWhen($this->ticket->number_of_person > 1, [
                'number_of_attendees' => $this->number_of_attendees,
            ]),
            'number_of_children' => $this->number_of_children,
            'note' => $this->note,
        ];
    }
}
