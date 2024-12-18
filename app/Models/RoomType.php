<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "room_type_name",
        "description",
        "base_price",
        "children",
        "adults"
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function count_room_available($start_at, $end_at)
    {
        $rooms = $this->rooms()->get();

        // Lọc các phòng khả dụng trong khoảng thời gian
        $availableRooms = $rooms->filter(function ($room) use ($start_at, $end_at) {
            return $room->is_available($start_at, $end_at);
        });
        return $availableRooms->count();
    }
}
