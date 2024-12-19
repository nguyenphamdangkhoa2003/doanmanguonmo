<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Pages\Customer\About;
use App\Livewire\Pages\Customer\BookingInfo;
use App\Livewire\Pages\Customer\Contact;
use App\Livewire\Pages\Customer\Home;
use App\Livewire\Pages\Customer\Policies;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

require __DIR__ . '/auth.php';
