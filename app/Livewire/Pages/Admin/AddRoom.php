<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\RoomForm;
use App\Models\Room;
use App\Models\RoomType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
#[Layout("components.layouts.admin")]
class AddRoom extends Component
{
    use Toast;
    public $room_type_id;
    public RoomForm $form;
    public function render()
    {
        $room_types = RoomType::all();
        return view('livewire.pages.admin.add-room', [
            "room_types" => $room_types
        ]);
    }

    public function save()
    {
        try {
            $this->form->validate();
            Room::create($this->form->pull());
            $this->success("Create room success!");
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function back()
    {
        return $this->redirectRoute("list-room");
    }
}
