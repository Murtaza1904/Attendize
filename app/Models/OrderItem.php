<?php

namespace App\Models;

use App\Models\MyBaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends MyBaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'quantity',
        'unit_price',
        'discount',
        'discount_code',
        'unit_booking_fee',
        'order_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
