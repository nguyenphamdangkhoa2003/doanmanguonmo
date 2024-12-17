<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        "url",
        "public_image_id",
        "user_id",
        "room_type_id",
        "banner_id",
    ];
}
