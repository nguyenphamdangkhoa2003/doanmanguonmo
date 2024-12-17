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

    Volt::route('login', 'pages.auth.login')
        ->name('login');

});