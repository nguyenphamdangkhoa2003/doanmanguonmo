<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingDetail extends Model
{
    protected $fillable = [
        "booking_id",
        "room_id",
        "check_in",
        "check_out",
        "quantity",
        "base_price",
    ];

    public function booking(): BelongsTo
    {
        return $this->BelongsTo(Booking::class);
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
