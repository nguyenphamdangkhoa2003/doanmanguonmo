<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $fillable = [
        "id",
        "payment_type",
        "amount",
        "payment_date",
        "user_id",
        "booking_id",
    ];

    public function booking(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
