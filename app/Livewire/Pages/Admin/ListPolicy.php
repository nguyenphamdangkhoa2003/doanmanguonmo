<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("components.layouts.admin")]
class ListPolicy extends Component
{
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'policy_type', 'label' => 'Type'],
            ['key' => 'action', 'label' => 'Action', 'sortable' => false] # <---- nested attributes
        ];
        $policies = Policy::all();
        return view('livewire.pages.admin.list-policy', [
            "headers" => $headers,
            "policies" => $policies
        ]);
    }

    public function redirectAddPolicy()
    {
        return $this->redirectRoute("add-policy");
    }

    public function redirectUpdatePolicy($id)
    {
        return $this->redirectRoute("update-policy", ["id" => $id]);
    }

    public function delete($id)
    {
        try {
            Policy::destroy($id);
        } catch (\Throwable $th) {

        }
    }
}
