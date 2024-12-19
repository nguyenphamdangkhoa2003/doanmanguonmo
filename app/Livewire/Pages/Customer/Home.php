<?php

namespace App\Livewire\Pages\Customer;

use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;
#[Layout("layouts.app")]
class Home extends Component
{
    use Toast;
    use WithPagination;
    public $roomCount = []; // Biến để lưu số lượng phòng đã nhập
    public array $selected_type_room = [];
    public $children;
    public $adults;
    public $start_date;
    public $end_date;
    public $type_rooms;
    public function mount()
    {
        $this->children = 0;
        $this->adults = 1;
        $this->start_date = Date::now()->toDateString(); // Định dạng: YYYY-MM-DD
        $this->end_date = Date::now()->addDay()->toDateString();

        $this->type_rooms = RoomType::all();
        foreach ($this->type_rooms as $key => $type_room) {
            $this->roomCount[$type_room->id] = 1;
        }
    }
    public function render()
    {
        // Lấy danh sách loại phòng phù hợp
        $this->type_rooms = RoomType::where("adults", ">=", $this->adults)->where("children", ">=", $this->children);
        return view('livewire.pages.customer.home', [
            'type_rooms' => $this->type_rooms,
        ]);
    }


    public function formatCustomDate($date)
    {
        $weekdays = [
            'Sunday' => 'CN',
            'Monday' => 'Th 2',
            'Tuesday' => 'Th 3',
            'Wednesday' => 'Th 4',
            'Thursday' => 'Th 5',
            'Friday' => 'Th 6',
            'Saturday' => 'Th 7',
        ];

        $dayOfWeek = $weekdays[$date->format('l')]; // Lấy ngày trong tuần
        $day = $date->format('j'); // Lấy ngày (1-31)
        $month = $date->format('n'); // Lấy tháng (1-12)
        $year = $date->format('y'); // Lấy 2 chữ số của năm

        return "{$dayOfWeek}, {$day} thg {$month}, {$year}";
    }
    public function formatCurrencyVND($number)
    {
        if (!is_numeric($number)) {
            return 'Số không hợp lệ';
        }

        $formattedNumber = number_format(abs($number), 0, ',', '.');
        $result = $formattedNumber . ' ₫';

        // Xử lý số âm
        if ($number < 0) {
            $result = '-' . $result;
        }

        return $result;
    }
    public function updated($key)
    {
        // Kiểm tra nếu tất cả các trường dữ liệu đã hợp lệ
        $validatedData = $this->validate([
            'children' => 'required|integer|min:0',
            'adults' => 'required|integer|min:1',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ]);
    }
}
