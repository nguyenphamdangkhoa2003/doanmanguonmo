<?php

use App\Models\AboutPage;
use App\Models\Banner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->text("content")->nullable();
            $table->timestamps();
        });
        Schema::table("banners", function (Blueprint $table) {
            $table->foreignIdFor(AboutPage::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
        Schema::table("banners", function (Blueprint $table) {
            $table->dropForeignIdFor(AboutPage::class);
        });
    }
};
