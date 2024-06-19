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
            'start_date_day' => $this->start_date->format('d'),
            'start_date_month' => $this->start_date->format('M'),
            'organiser' => $this->organiser->name,
            'tickets_sold' => $this->tickets->sum('quantity_sold'),
            'revenue' => $this->getEventRevenueAmount()->display(),
        ];
    }
}
