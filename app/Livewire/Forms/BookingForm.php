<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    public $cus_name;
    public $cus_email;
    public $cus_phone;
    public $total_price;
    public $cus_address;

    protected function rules(): array
    {
        return [
            'cus_name' => ['required', 'string', 'max:255'],
            'cus_email' => ['required', 'email', 'max:255'],
            'cus_phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'cus_address' => ['required', 'string', 'max:500'],
        ];
    }

    protected function messages(): array
    {
        return [
            'cus_name.required' => 'Customer name is required.',
            'cus_email.required' => 'Customer email is required.',
            'cus_email.email' => 'Please enter a valid email address.',
            'cus_phone.required' => 'Customer phone number is required.',
            'cus_phone.regex' => 'Please enter a valid phone number.',
            'total_price.required' => 'Total price is required.',
            'total_price.numeric' => 'Total price must be a number.',
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'room_type_id.required' => 'Room type ID is required.',
            'room_type_id.exists' => 'The selected room type does not exist.',
            'payment_id.required' => 'Payment ID is required.',
            'payment_id.exists' => 'The selected payment does not exist.',
            'cus_address.max' => 'Customer address cannot exceed 500 characters.',
        ];
    }
}
