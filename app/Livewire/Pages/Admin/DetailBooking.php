<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \Illuminate\Support\Facades\Route;
#[Layout("components.layouts.admin")]
class DetailBooking extends Component
{
    public function render()
    {
        $id = Route::current()->parameter("id");
        $booking = Booking::find($id);
        $booking_details = $booking->booking_details;
        return view('livewire.pages.admin.detail-booking', [
            "booking" => $booking,
            "booking_details" => $booking_details,
        ]);
    }
}
