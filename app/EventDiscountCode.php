<?php

namespace App;

use App\Models\MyBaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventDiscountCode extends MyBaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'event_id' ,'code', 'discount_percentage', 'limit', 'usage', 'expiry_date',
    ];

    public function rules()
    {
        return [
            'code' => 'required|string|max:191',
            'discount_percentage' => 'required|numeric',
            'limit' => 'required|numeric',
            'usage' => 'nullable|numeric',
            'expiry_date' => 'required|date_format:d-m-Y',
        ];
    }
}
