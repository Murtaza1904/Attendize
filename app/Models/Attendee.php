<?php namespace App\Models;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends MyBaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'event_id',
        'order_id',
        'ticket_id',
        'account_id',
        'reference',
        'has_arrived',
        'arrival_time',
        'number_of_attendees',
        'number_of_children',
        'note',
    ];

    protected $casts = [
        'is_refunded'  => 'boolean',
        'is_cancelled' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {

            do {
                //generate a random string using Laravel's Str::Random helper
                $token = Str::Random(15);
            } //check if the token already exists and if it does, try again

            while (Attendee::where('private_reference_number', $token)->first());
            $order->private_reference_number = $token;
        });

    }

    public static function findFromSelection(array $attendeeIds = [])
    {
        return (new static)->whereIn('id', $attendeeIds)->get();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function scopeWithoutCancelled($query)
    {
        return $query->where('attendees.is_cancelled', '=', 0);
    }

    public function getReferenceAttribute()
    {
        return $this->order->order_reference . '-' . $this->reference_index;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'arrival_time'];
    }
}
