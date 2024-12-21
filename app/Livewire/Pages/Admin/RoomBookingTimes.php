<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Room;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \Illuminate\Support\Facades\Route;
#[Layout("components.layouts.admin")]
class RoomBookingTimes extends Component
{
    public $room;
    public array $events = [];

    public function render()
    {
        $id = Route::current()->parameter("id");
        $room = Room::findOrFail($id);

        if ($room) {
            $booking_details = $room->booking_details;
            foreach ($booking_details as $booking_detail) {
                $start = Carbon::parse($booking_detail->check_in)->addDay()->toDateTimeString();
                $end = Carbon::parse($booking_detail->check_out)->addDay()->toDateTimeString();
                $this->events[] = [
                    "id" => $booking_detail->id,
                    "title" => "Booked",
                    "start" => $start,
                    "end" => $end,
                ];
            }
        }

        // Emit sự kiện để client render lại
        $this->dispatch('reloadCalendar', ['events' => $this->events]);
        return view('livewire.pages.admin.room-booking-times');
    }
}
