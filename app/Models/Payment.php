<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'card_name',
        'card_number',
        'expiry_date',
        'ccv',
        'payment_status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
