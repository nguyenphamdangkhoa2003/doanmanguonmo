<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoomForm extends Form
{
    public $room_number;
    public $room_type_id;
    protected function rules()
    {
        return [
            'room_number' => 'required|string|max:50|unique:rooms,room_number',
            'room_type_id' => 'required|integer|exists:room_types,id',
        ];
    }
}
