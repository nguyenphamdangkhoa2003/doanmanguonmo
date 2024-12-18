<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\RoomTypeForm;
use App\Models\Image;
use App\Models\RoomType;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Validator;

class AddRoomType extends Component
{
    use Toast;
    use WithFileUploads;
    #[Validate("required")]
    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];
    public RoomTypeForm $form;
    #[Layout("components.layouts.admin")]
    public function render()
    {
        return view('livewire.pages.admin.add-room-type');
    }
    public function save()
    {
        $this->validate();
        $this->form->validate();
        $room_type = RoomType::create(
            $this->form->pull(),
        );
        foreach ($this->photos as $photo) {
            $cloundinary = cloudinary()->upload($photo->getRealPath());
            Image::create([
                "url" => $cloundinary->getSecurePath(),
                "public_image_id" => $cloundinary->getPublicId(),
                "room_type_id" => $room_type->id,
            ]);
        }
        $this->success("Create type room success!");
        return $this->redirectRoute("list-type-room");
    }

    public function back()
    {
        return $this->redirectRoute("list-type-room");
    }

}
