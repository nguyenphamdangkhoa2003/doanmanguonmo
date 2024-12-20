<?php

namespace App\Livewire\Pages\Customer;

use App\Livewire\Forms\ContactMessageForm;
use App\Models\ContactMessage;
use App\Models\ContactPage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
#[Layout("layouts.app")]
class Contact extends Component
{
    use Toast;
    public ContactPage $contact_page;
    public ContactMessageForm $form;
    public function render()
    {
        $this->contact_page = ContactPage::firstOrCreate(["id" => 1, "address" => "80, Cao Lỗ, Phường 4, Quận 8, Thành phố Hồ Chí Minh", "phone" => "0326654505", "description" => "Đây là mô tả", "email" => "dangkhoa2k30@gmail.com"]);
        return view('livewire.pages.customer.contact');
    }
    public function send()
    {
        $this->form->validate();
        $contact_mess = ContactMessage::create($this->form->pull());
        $this->success("Send successfully!");
    }
}
