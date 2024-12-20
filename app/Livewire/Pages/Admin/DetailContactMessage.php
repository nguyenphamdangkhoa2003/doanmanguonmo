<?php

namespace App\Livewire\Pages\Admin;

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \Illuminate\Support\Facades\Route;
#[Layout("components.layouts.admin")]
class DetailContactMessage extends Component
{
    public function render()
    {
        $id = Route::current()->parameter("id");
        $message = ContactMessage::findOrFail($id);
        $message->update(["is_readed" => 1]);
        return view('livewire.pages.admin.detail-contact-message', [
            "message" => $message,
        ]);
    }
}
