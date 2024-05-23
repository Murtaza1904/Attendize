<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionTax extends Model
{
    protected $fillable = ['region', 'tax_type', 'tax', 'payment_gateway'];
}
