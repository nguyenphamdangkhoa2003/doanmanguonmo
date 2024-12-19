<?php

namespace App\Livewire\Pages\Customer;


use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("layouts.app")]
class BookingHistory extends Component
{
    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view(
            'livewire.pages.customer.booking-history',
            [
                "booking_history" => $user->booking_history,
            ]
        );
    }
}
