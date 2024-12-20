<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactPage extends Model
{
    protected $fillable = [
        "address",
        "phone",
        "email",
        "description",
        "is_readed"
    ];
}
