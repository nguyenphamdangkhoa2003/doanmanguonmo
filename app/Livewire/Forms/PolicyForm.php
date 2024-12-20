<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PolicyForm extends Form
{
    public $policy_type;
    public $description;
    public function rules()
    {
        return [
            'policy_type' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ];
    }
}
