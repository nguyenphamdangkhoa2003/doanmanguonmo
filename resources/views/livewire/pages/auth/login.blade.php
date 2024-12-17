<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-2xl text-center font-extrabold py-2">Login</h1>

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-mary-input wire:model="form.email" label="Email" placeholder="Email Address" icon-right="o-envelope" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-mary-password label="Password" placeholder="Password" wire:model="form.password" right />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-mary-checkbox label="Remember me" wire:model="form.remember" />
        </div>

        <div class="flex flex-col items-center justify-end mt-4">
            <x-mary-button type="submit" label="LOGIN" class="rounded-full w-full text-xl text-white btn-primary" />
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 text-end w-full dark:text-gray-400  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:text-primary"
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

    </form>
</div>
