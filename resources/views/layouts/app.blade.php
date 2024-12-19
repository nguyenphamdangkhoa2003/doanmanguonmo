<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased relative bg-secondary">
    <div class=" shadow-md sticky top-0 z-50 bg-primary">
        <div class="lg:max-w-6xl px-6 mx-auto navbar text-lg py-0">
            <div class="navbar-start">
                KhachSan2k
            </div>
            <div class="navbar-center hidden lg:flex">
                <x-mary-menu activate-by-route class="flex-row py-0">
                    <x-mary-menu-item
                        class="rounded-none text-lg hover:border-b-2 hover:border-black {{ request()->routeIs('home') ? 'border-b-2 border-black' : '' }}"
                        title="Home" />
                    <x-mary-menu-item class="rounded-none text-lg hover:border-b-2 hover:border-black " title="About" />
                    <x-mary-menu-item class="rounded-none text-lg hover:border-b-2 hover:border-black "
                        title="Contact" />
                    <x-mary-menu-item class="rounded-none text-lg hover:border-b-2 hover:border-black "
                        title="Policies" />
                </x-mary-menu>
            </div>
            <div class="navbar-end flex-none gap-2">

                <div class="dropdown dropdown-end">
                    @if (Auth::check())
                        <div class="flex items-center gap-5">
                            <span class="text-sm">{{ Auth::user()->name }}</span>
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img src="
                                                                                                    {{ Auth::user()->avatar->url ?? Vite::asset('resources/images/user_default.png') }}
                                                                                                    " />
                                </div>
                            </div>
                        </div>
                        <ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-4 w-52 p-2 shadow">
                            <li>
                                <a class="hover:underline" href="{{ route('profile') }}">
                                    Profile
                                </a>
                            </li>

                            <li><a class=" hover:underline" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    @else
                        <x-mary-button label="Login" link="{{ route('login') }}" class="btn-ghost btn-sm" responsive />
                        <x-mary-button label="Register" link="{{ route('register') }}" class="btn-ghost btn-sm"
                            responsive />
                    @endif
                </div>

            </div>
        </div>
    </div>
    <x-mary-main with-nav full-width>
        <x-slot:content class="!py-0 !p-0 relative">
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
    @livewire('layout/customer/footer')
    </div>
</body>

</html>