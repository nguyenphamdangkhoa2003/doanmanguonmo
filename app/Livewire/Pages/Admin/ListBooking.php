<?php

namespace App\Livewire\Pages\Admin;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
#[Layout("components.layouts.admin")]
class ListBooking extends Component
{
    use Toast;
    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'status', 'label' => 'Status'],
        ["key" => "total_price", "label" => "Total price"],
        ["key" => "action", "label" => "Action", 'sortable' => false],
    ];
    public array $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public string $search = "";
    public function render()
    {
        $bookings = Booking::query()
            ->when($this->search, function (Builder $q) {
                $q->where(function ($query) {
                    $query->where('id', 'like', "%$this->search%");
                });
            })
            ->orderBy(...array_values($this->sortBy));
        return view('livewire.pages.admin.list-booking', [
            "bookings" => $bookings
        ]);
    }
}
