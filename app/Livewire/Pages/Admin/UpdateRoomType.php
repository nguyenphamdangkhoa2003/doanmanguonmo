<?php

namespace App\Livewire\Pages\Admin;

use App\Livewire\Forms\RoomTypeForm;
use App\Models\Image;
use App\Models\RoomType;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use \Illuminate\Support\Facades\Route;

class UpdateRoomType extends Component
{
    use WithFileUploads;
    use Toast;
    public RoomTypeForm $form;
    #[Validate("required")]
    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];
    public $existingImages = [];
    public $id;
    public $flag;
    #[Layout("components.layouts.admin")]

    public function mount()
    {
        $this->flag = false;
        $this->id = Route::current()->parameter("id");
        $room_type = RoomType::findOrFail($this->id);
        $this->form->room_type_name = $room_type->room_type_name;
        $this->form->description = $room_type->description;
        $this->form->base_price = $room_type->base_price;
        $this->form->children = $room_type->children ?? 0;
        $this->form->adults = $room_type->adults;
        $this->photos = $room_type->images;

        $this->existingImages = $room_type->images()->pluck('url')->toArray();
    }
    public function render()
    {

        return view('livewire.pages.admin.update-room-type');
    }

    public function back()
    {
        return $this->redirectRoute("list-type-room");
    }
    public function updatedPhotos()
    {
        $this->flag = true;
        // Khi ngÆ°á»i dÃ¹ng upload hÃ¬nh áº£nh, chá»‰ hiá»ƒn thá»‹ cÃ¡c file má»›i
        $this->existingImages = [];
        foreach ($this->photos as $photo) {
            $this->existingImages[] = $photo->temporaryUrl();
        }
    }
    public function save()
    {
        $this->form->validate();
        $room_type = RoomType::findOrFail($this->id);
        $room_type->update($this->form->pull());
        if ($this->flag) {
            $this->validate();
            $images = $room_type->images;
            foreach ($images as $key => $value) {
                Cloudinary::destroy($value->public_image_id);
                Image::destroy($value->id);
            }
            foreach ($this->photos as $photo) {
                $cloundinary = cloudinary()->upload($photo->getRealPath());
                Image::create([
                    "url" => $cloundinary->getSecurePath(),
                    "public_image_id" => $cloundinary->getPublicId(),
                    "room_type_id" => $room_type->id,
                ]);
            }
        }
        $this->success("Update type room success!");
        return $this->redirectRoute("list-type-room");
    }
}
