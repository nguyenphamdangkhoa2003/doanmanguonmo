<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    <div class="flex !w-full justify-between">

        <form wire:submit="updateProfileInformation" class="mt-6 space-y-6 flex-1 max-w-xl">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                    autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="name" :value="__('Phone')" />
                <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full" required
                    autofocus autocomplete="phone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div>
                <x-input-label for="name" :value="__('Address')" />
                <x-text-input wire:model="address" id="address" name="address" type="text" class="mt-1 block w-full"
                    required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>



            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                    autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 ">
                            {{ __('Your email address is unverified.') }}

                            <button wire:click.prevent="sendVerification"
                                class="underline text-sm text-gray-600 d hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 ">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-mary-button class="btn-primary" spinner="updateProfileInformation"
                    type="submit">{{ __('Save') }}</x-mary-button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
        <div class="flex-1 flex justify-center items-center flex-col">
            <x-mary-file wire:model="photo" accept="image/png, image/jpeg">
                <img src="{{ Auth::user()->avatar->url ?? Vite::asset('resources/images/user_default.png') }}"
                    class="h-40 rounded-lg" accept="image/*" />
            </x-mary-file>
            <p class="text-center">Avatar</p>
        </div>
    </div>
</section>