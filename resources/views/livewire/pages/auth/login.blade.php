<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
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
        <div class="py-3 text-center text-gray-600 text-sm">Or Login With </div>
        <a class="px-4 py-2 w-full items-center justify-center border flex gap-2 border-slate-200  rounded-lg text-slate-700  hover:border-slate-400  hover:text-slate-900 hover:shadow transition duration-150 cursor-pointer"
            href="{{ route('login-by-google') }}">
            <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy"
                alt="google logo">
            <span>Login with Google</span>
        </a>
        <div class=" w-full text-center">
            <a href="{{ route('register') }}" class="py-3 text-sm link link-primary">Register a new account</a>
        </div>
    </form>
</div>
