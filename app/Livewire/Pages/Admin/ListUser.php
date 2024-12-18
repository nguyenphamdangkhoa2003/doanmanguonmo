<?php

namespace App\Livewire\Pages\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

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
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.pages.admin.list-user', [
            "users" => User::all()
        ]);
    }
}
