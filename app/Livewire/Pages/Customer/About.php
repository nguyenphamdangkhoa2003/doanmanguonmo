<?php

namespace App\Livewire\Pages\Customer;

use App\Models\AboutPage;
use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Component;

class About extends Component
{
    public ?Banner $banner;
    public ?AboutPage $about_page;
    #[Layout("layouts.app")]
    public function render()
    {
        $slides = [];
        $this->about_page = AboutPage::first();
        $this->banner = Banner::first();
        if ($this->banner != null) {
            $slides = [];
            foreach ($this->banner->images as $image) {
                $slides[] = ["image" => $image->url];
            }
        }
        return view('livewire.pages.customer.about', [
            "slides" => $slides,
        ]);
    }
}
