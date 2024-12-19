<?php

namespace App\Livewire\Pages\Customer;

use App\Livewire\Forms\BookingForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingInfo extends Component
{

    public int $step = 1;
    public $selected_type_room = [];
    public BookingForm $form;
    public $content;
    public function render()
    {
        $user = Auth::user();
        $this->form->cus_address = $user->address;
        $this->form->cus_email = $user->email;
        $this->form->cus_name = $user->name;
        $this->form->cus_phone = $user->phone;
        $this->form->total_price = session()->get("total_price", 0);
        $this->selected_type_room = session()->get("selected_type_room", []);
        $this->content = "Giao dich cua khach hang co id " . Auth::user()->id . ", So tien " . $this->form->total_price;
        return view('livewire.pages.customer.booking-info');
    }
    public function confirmInfoUser()
    {
        $this->form->validate();
        $this->next();
    }
    public function next()
    {
        if ($this->step + 1 > 3) {
            $this->step = 2;
        } else {
            $this->step += 1;
        }
    }

    public function prev()
    {
        if ($this->step - 1 < 1) {
            $this->step = 1;
        } else {
            $this->step -= 1;

        }
    }
    public function deleteTypeRoomSelected($key)
    {
        unset($this->selected_type_room[$key]);
    }
    function generateTxnRef()
    {
        return time() . mt_rand(1000, 9999); // Thời gian hiện tại kết hợp với số ngẫu nhiên
    }
}
