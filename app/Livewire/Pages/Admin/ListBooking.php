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
            ->orderBy(...array_values($this->sortBy))
            ->paginate(5);
        return view('livewire.pages.admin.list-booking', [
            "bookings" => $bookings
        ]);
    }

    public function approve($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return $this->error("Not found");
        }
        $booking->status = "confirm";
        $booking->save();
        return $this->success("Approve successfully");

    }

    public function delete($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return $this->error("Not found");
        }
        $booking->status = "cancel";
        $booking->save();
        return $this->success("Cancel successfully");
    }

    public function detail($id)
    {
        return $this->redirectRoute("detail-booking", ["id" => $id]);
    }
}
