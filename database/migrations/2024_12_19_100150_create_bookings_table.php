<?php

use App\Models\Payment;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string("cus_name");
            $table->string("cus_email");
            $table->string("cus_phone");
            $table->string("cus_address");
            $table->double("total_price");
            $table->enum("status", ["pending", "confirm", "cancel"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("bookings");
    }
};
