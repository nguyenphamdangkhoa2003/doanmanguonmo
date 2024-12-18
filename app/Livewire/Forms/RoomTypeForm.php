<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoomTypeForm extends Form
{  // Notice `*` syntax for validate each file
    public $room_type_name;
    public $description;
    public $base_price;
    public $children;
    public $adults;
    protected function rules()
    {
        return [
            'room_type_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'base_price' => 'required|numeric|min:0',
            'children' => 'required|integer|min:0',
            'adults' => 'required|integer|min:1',
        ];
    }
}
