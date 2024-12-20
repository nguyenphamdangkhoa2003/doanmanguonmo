<?php

namespace App\Livewire\Pages\Admin;

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("components.layouts.admin")]
class ListContactMessage extends Component
{
    public function render()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.admin.list-contact-message', [
            "messages" => $messages,
        ]);
    }

    public function delete($id)
    {
        ContactMessage::destroy($id);
    }
}
