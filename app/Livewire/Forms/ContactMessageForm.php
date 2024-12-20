<?php
namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactMessageForm extends Form
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $message;
    public $is_readed = false;

    /**
     * Validation rules for the form.
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string|max:1000',
        ];
    }
}
