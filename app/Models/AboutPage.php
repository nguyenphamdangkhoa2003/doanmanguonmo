<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AboutPage extends Model
{
    protected $fillable = [
        "id",
        "content",
    ];
}
