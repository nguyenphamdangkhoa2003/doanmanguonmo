<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Pages\Customer\About;
use App\Livewire\Pages\Customer\BookingInfo;
use App\Livewire\Pages\Customer\Contact;
use App\Livewire\Pages\Customer\Home;
use App\Livewire\Pages\Customer\Policies;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('about', About::class)
    ->name('about');
Route::get('contact', Contact::class)
    ->name('contact');
Route::get("/vnpay_php", [PaymentController::class, "vnpay_payment"])->name("vnpay_php");
require __DIR__ . '/auth.php';
