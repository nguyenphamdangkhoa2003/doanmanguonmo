<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Arr;
use \Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Route;
class Dashboard extends Component
{
    use WithPagination;
    public array $rooms_chart = [];
    public array $revent_chart = [];
    public array $user_chart = [];

    public function mount(
    ) {
        $date = Carbon::parse(now());
        $rooms = Room::all();
        $count_room_availabel = $rooms->filter(fn($room) => $room->is_available(Date::today(), Date::today()))->count();
        $count_room = $rooms->count();
        $this->rooms_chart = [
            'type' => 'pie',
            'data' => [
                'labels' => ['Booked', 'Avalable'],
                'datasets' => [
                    [
                        'label' => '# of Rooms',
                        'data' => [$count_room - $count_room_availabel, $count_room_availabel],
                    ]
                ]
            ],
        ];

       

    }

    public function switch()
    {
        $type = $this->rooms_chart['type'] == 'bar' ? 'pie' : 'bar';
        Arr::set($this->rooms_chart, 'type', $type);
    }
    #[Layout('components.layouts.admin')]


    public function render()
    {
        $userCount = User::count();
        $users = User::paginate(5);
        $bookingCount = Booking::count();
        $totalPaymentCount = Payment::sum('amount');
        $roomCount = Room::count();
        return view('livewire.pages.admin.dashboard', compact('userCount', 'bookingCount', 'totalPaymentCount', 'roomCount', 'users'));
    }
}
