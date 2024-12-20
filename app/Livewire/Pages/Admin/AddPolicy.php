<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\PolicyForm;
use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
#[Layout("components.layouts.admin")]
class AddPolicy extends Component
{
    use Toast;
    public PolicyForm $form;
    public function render()
    {
        return view('livewire.pages.admin.add-policy');
    }

    public function save()
    {
        $this->form->validate();
        Policy::create($this->form->pull());
        $this->success("Create policy successfully");
        return $this->redirectRoute("list-policy");
    }
}
