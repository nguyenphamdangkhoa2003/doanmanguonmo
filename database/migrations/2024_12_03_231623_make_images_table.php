<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("images", function (Blueprint $table) {
            $table->id();
            $table->string("public_image_id");
            $table->string("url")->default("https://res.cloudinary.com/dff6pkxpt/image/upload/v1733269200/defaultImage_feihcw.png");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("images");
    }
};
