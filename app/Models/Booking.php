<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        "total_price",
        "cus_name",
        "cus_email",
        "cus_phone",
        "user_id",
        "cus_address",

    ];

    public function booking_details(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public static function getMonthlyRevenue($month, $year)
    {
        return Booking::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('total_price');
    }
}
