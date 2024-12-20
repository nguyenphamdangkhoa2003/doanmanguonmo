<?php

namespace App\Livewire\Pages\Admin;

use App\Models\AboutPage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
#[Layout("components.layouts.admin")]
class AboutPageSetting extends Component
{
    use Toast;
    public $content = "";
    public $id;
    public function render()
    {
        $about_page = AboutPage::firstOrCreate(["id" => "1"]);
        $this->content = $about_page->content;
        return view('livewire.pages.admin.about-page-setting');
    }

    public function save()
    {

        // Save logic here (giả sử lưu vào bảng AboutPage)
        AboutPage::updateOrCreate(
            ['id' => 1], // Cập nhật nếu tồn tại, hoặc tạo mới
            ['content' => $this->content]
        );

        // Flash a success message
        $this->success('About page content saved successfully!');
    }
}
