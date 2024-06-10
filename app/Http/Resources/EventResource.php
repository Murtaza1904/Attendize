<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' => $this->start_date->format('d-m-Y'),
            'end_date' => $this->end_date->format('d-m-Y'),
        ];
    }
}
