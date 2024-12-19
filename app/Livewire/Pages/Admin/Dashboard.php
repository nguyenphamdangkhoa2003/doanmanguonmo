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
        
        $this->revent_chart = [
            "type" => "line",
            "data" => [
                "labels" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                "datasets" => [
                    [
                        "label" => "# of months",
                        "data" => [
                            Booking::getMonthlyRevenue("1", $date->year),
                            Booking::getMonthlyRevenue("2", $date->year),
                            Booking::getMonthlyRevenue("3", $date->year),
                            Booking::getMonthlyRevenue("4", $date->year),
                            Booking::getMonthlyRevenue("5", $date->year),
                            Booking::getMonthlyRevenue("6", $date->year),
                            Booking::getMonthlyRevenue("7", $date->year),
                            Booking::getMonthlyRevenue("8", $date->year),
                            Booking::getMonthlyRevenue("9", $date->year),
                            Booking::getMonthlyRevenue("10", $date->year),
                            Booking::getMonthlyRevenue("11", $date->year),
                            Booking::getMonthlyRevenue("12", $date->year),
                        ]
                    ]
                ]
            ]
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
