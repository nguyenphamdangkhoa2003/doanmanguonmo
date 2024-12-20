<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AboutPage;
use App\Models\Banner;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\WithMediaSync;
#[Layout("components.layouts.admin")]
class Banners extends Component
{
    use WithFileUploads;
    #[Rule(['photos' => 'required'])]          // A separated rule to make it required
    #[Rule(['photos.*' => 'image|max:1024'])]   // Notice `*` syntax for validate each file
    public array $photos = [];
    public Collection $images;
    public ?Banner $banner;
    public function render()
    {
        $this->banner = Banner::all()->first();
        if ($this->banner != null) {
            $this->images = $this->banner->images;
        }
        return view('livewire.pages.admin.banners');
    }
}
