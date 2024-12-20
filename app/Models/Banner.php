<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Attributes\Layout;
class Banner extends Model
{
    protected $fillable = [
        "id",
        "about_page_id"
    ];  
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
