<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(\+?\d{1,4}[-.\s]?|)?\(?\d{1,4}\)?[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
<form wire:submit="register">
        <h1 class="text-2xl text-center font-extrabold py-2">Register</h1>
        <!-- Name -->
        <div>
            <x-mary-input wire:model="name" label="Username" placeholder="Username" icon-right="o-user" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-mary-input wire:model="email" label="Email" placeholder="Email Address" icon-right="o-envelope" />
        </div>

        {{-- Phone --}}
        <div class="mt-4">
            <x-mary-input wire:model="phone" label="Phone" icon-right="o-device-phone-mobile" placeholder="Phone" />
        </div>

        {{-- Address --}}
        <div class="mt-4">
            <x-mary-input wire:model="address" label="Address" icon-right="s-map-pin" placeholder="Address" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-mary-password label="Password" placeholder="Password" wire:model="password" right />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-mary-password label="Confirm Password" placeholder="Confirm Password" wire:model="password_confirmation"
                right />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class=" ms-4">
                {{ __('Register ') }} <span wire:loading><x-mary-loading /></span>

            </x-primary-button>
        </div>
    </form>
</div>
