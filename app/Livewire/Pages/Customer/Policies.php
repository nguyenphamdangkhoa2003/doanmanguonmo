<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("layouts.app")]
class Policies extends Component
{
    public function render()
    {
        $policies = Policy::all();
        return view(
            'livewire.pages.customer.policies',
            ["policies" => $policies]
        );
    }
}
