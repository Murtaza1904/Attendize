<?php

namespace App;

use App\Models\MyBaseModel;

class EventFaq extends MyBaseModel
{
    protected $fillable = [
        'event_id', 'question', 'answer',
    ];

    public function rules()
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
        ];
    }
}
