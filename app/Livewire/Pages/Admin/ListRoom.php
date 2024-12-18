<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Room;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class ListRoom extends Component
{
    use Toast;
    use WithPagination;
    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'room_number', 'label' => 'Room Number'],
        ["key" => "room_type.room_type_name", "label" => "Room Type"],
        ["key" => "action", "label" => "Action", 'sortable' => false]
    ];
    #[Layout("components.layouts.admin")]
    public array $sortBy = ['column' => 'room_number', 'direction' => 'asc'];
    public string $search = "";
    public function render()
    {
        $rooms = Room::query()
            ->when($this->search, function (Builder $q) {
                $q->where(function ($query) {
                    $query->where('id', 'like', "%$this->search%")->orWhere("room_number", 'like', "%$this->search%");
                });
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(5);
        return view('livewire.pages.admin.list-room', [
            "rooms" => $rooms,
        ]);
    }

    public function delete($id)
    {
        try {
            Room::destroy($id);
            $this->success("Delete success!");
        } catch (\Throwable $th) {
            $this->error("Delete fail!");
        }
    }
}
