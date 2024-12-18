<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthenticationProvider;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CheckDefaultPasswordMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use App\Livewire\Actions\Logout;
use App\Livewire\Pages\Admin\AboutPageSetting;
use App\Livewire\Pages\Admin\AddPolicy;
use App\Livewire\Pages\Admin\AddRoom;
use App\Livewire\Pages\Admin\AddRoomType;
use App\Livewire\Pages\Admin\Banners;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\DetailBooking;
use App\Livewire\Pages\Admin\DetailContactMessage;
use App\Livewire\Pages\Admin\ListBooking;
use App\Livewire\Pages\Admin\ListContactMessage;
use App\Livewire\Pages\Admin\ListPolicy;
use App\Livewire\Pages\Admin\ListRoom;
use App\Livewire\Pages\Admin\ListTypeRoom;
use App\Livewire\Pages\Admin\ListUser;
use App\Livewire\Pages\Admin\RoomBookingTimes;
use App\Livewire\Pages\Admin\UpdatePolicy;
use App\Livewire\Pages\Admin\UpdateRoom;
use App\Livewire\Pages\Admin\UpdateRoomType;
use App\Livewire\Pages\Customer\BookingHistory;
use App\Livewire\Pages\Customer\BookingInfo;
use App\Livewire\Pages\Customer\PaymentSuccess;
use App\Livewire\Pages\Customer\UpdatePassword;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
    Volt::route('login', 'pages.auth.login')
        ->name('login');
    Volt::route('register', 'pages.auth.register')
        ->name('register');
    Route::get("/auth/redirect/google", [AuthenticationProvider::class, "redirect_provider"])->name("login-by-google");

    Route::get("/auth/callback/google", [AuthenticationProvider::class, "authentication_callback"]);
});


Route::middleware("auth")->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');
    Route::get("/log-out", Logout::class)->name("logout");

});
Route::middleware(["auth", IsAdminMiddleware::class])->group(function () {
    Volt::route("admin/list-user", ListUser::class)->name("list-user");
    Volt::route("admin/list-room", ListRoom::class)->name("list-room");
    Volt::route("admin/add-room", AddRoom::class)->name("add-room");
    Volt::route("admin/update-room/{id}", UpdateRoom::class)->name("update-room");

    Volt::route("admin/list-type-room", ListTypeRoom::class)->name("list-type-room");
});