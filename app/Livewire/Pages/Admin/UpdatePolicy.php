<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\PolicyForm;
use App\Models\Policy;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
use \Illuminate\Support\Facades\Route;
#[Layout("components.layouts.admin")]
class UpdatePolicy extends Component
{

    use Toast;
    public $id;
    public PolicyForm $form;
    public function render()
    {
        $this->id = Route::current()->parameter("id");
        $policy = Policy::findOrFail($this->id);
        if ($policy) {
            $this->form->policy_type = $policy->policy_type;
            $this->form->description = $policy->description;
        }
        return view('livewire.pages.admin.update-policy');
    }
    public function save()
    {
        $this->form->validate();
        $policy = Policy::findOrFail($this->id);
        if ($policy) {
            $policy->update($this->form->pull());
            $this->success("Update successfully!");
            return $this->redirectRoute("list-policy");
        } else {
            $this->error("Policy id not match");
        }
    }
}
