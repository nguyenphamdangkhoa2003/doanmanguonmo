<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \Illuminate\Support\Facades\Route;
#[Layout("components.layouts.admin")]
class RoomBookingTimes extends Component
{
    public array $events = [];

    public function mount()
    {
        $id = Route::current()->parameter("id");
        $room = Room::findOrFail($id);
    
        if ($room) {
            $booking_details = $room->booking_details;
            foreach ($booking_details as $booking_detail) {
                $this->events[] = [
                    "id" => $booking_detail->id,
                    "title" => "Booked",
                    "start" => $booking_detail->check_in,
                    "end" => $booking_detail->check_out,
                ];
            }
        }
    
        // Emit sự kiện để client render lại
        $this->dispatch('reloadCalendar', ['events' => $this->events]);
    }

    public function render()
    {
        return view('livewire.pages.admin.room-booking-times');
    }
}
