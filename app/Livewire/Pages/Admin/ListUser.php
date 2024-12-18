<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('components.layouts.admin')]
class ListUser extends Component
{
    use WithPagination;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public string $search = "";
    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => "Role"] # <---- nested attributes
    ];

    public function render()
    {
        return view('livewire.pages.admin.list-user', [
            "users" => User::query()
                ->when($this->search, function (Builder $q) {
                    $q->where(function ($query) {
                        $query->where('name', 'like', "%$this->search%")
                            ->orWhere('email', 'like', "%$this->search%")
                            ->orWhere('id', 'like', "%$this->search%");
                    });
                })
                ->orderBy(...array_values($this->sortBy))
                ->paginate(5)
        ]);
    }
}
