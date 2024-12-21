<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        "room_number",
        "room_type_id",
        "start_date",
        "end_date"
    ];

    public function room_type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
    public function booking_details(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }
    public function is_available($startDate, $endDate): bool
    {
        // Chuyển đổi ngày truyền vào thành đối tượng Carbon để so sánh
        $inputStartDate = Carbon::parse($startDate);
        $inputEndDate = Carbon::parse($endDate);

        // Lấy tất cả các booking liên quan đến phòng này
        $bookings = $this->booking_details;

        // Kiểm tra nếu bất kỳ booking nào có khoảng thời gian giao với input thì không khả dụng
        foreach ($bookings as $booking) {
            $bookingStartDate = Carbon::parse($booking->check_in);
            $bookingEndDate = Carbon::parse($booking->check_out);

            // Nếu khoảng thời gian giao nhau, phòng không khả dụng
            if (
                $inputStartDate >= $bookingStartDate && $inputStartDate < $bookingEndDate || $inputEndDate >= $bookingStartDate && $inputEndDate < $bookingEndDate
            ) {
                return false;
            }

        }

        // Nếu không có giao, phòng khả dụng
        return true;
    }

}
