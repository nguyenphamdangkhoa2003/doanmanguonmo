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
            <div class="navbar-start hidden lg:block">
                KhachSan2k
            </div>

            <div class="navbar-center lg:hidden flex items-center">
                <label for="mobile-menu-toggle" class="cursor-pointer">
                    <!-- Hamburger Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </label>
            </div>

            <!-- Checkbox to toggle menu -->
            <input type="checkbox" id="mobile-menu-toggle" class="hidden peer ">

            <!-- Menu Section -->
            <div
                class="lg:navbar-center transition-all duration-200 peer-checked:flex hidden lg:flex absolute lg:static top-full left-0 w-full lg:w-auto bg-primary lg:bg-transparent flex-col lg:flex-row lg:items-center gap-4 p-4 lg:p-0">
                <x-mary-menu activate-by-route
                    class="lg:flex-row flex-col lg:py-0 lg:w-auto items-center transition-all duration-200">
                    <x-mary-menu-item
                        class="rounded-none text-lg hover:border-b-2 border-black text-black transition-all duration-200 {{ request()->routeIs('home') ? 'border-b-2 border-black' : '' }}"
                        title="Home" link="{{ route('home') }}" />
                    <x-mary-menu-item
                        class="rounded-none text-lg hover:border-b-2 border-black text-black transition-all duration-200"
                        title="About" />
                    <x-mary-menu-item
                        class="rounded-none text-lg hover:border-b-2 border-black text-black transition-all duration-200"
                        title="Contact" />
                    <x-mary-menu-item
                        class="rounded-none text-lg hover:border-b-2 border-black text-black transition-all duration-200"
                        title="Policies" />
                    <div class="lg:hidden flex flex-col items-center">
                        <h3 class="text-lg text-black font-semibold border-b border-white pt-6 pb-2">SETTINGS</h3>
                        <ul tabindex="0" class="lg:hidden block ">
                            <li>
                                <a class="hover:underline text-lg" href="{{ route('profile') }}">
                                    Profile
                                </a>
                            </li>

                            <li><a class=" hover:underline text-lg" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </x-mary-menu>
            </div>


            <div class="navbar-end flex-none gap-2 hidden lg:flex">

                <div class="dropdown dropdown-end">
                    @if (Auth::check())
                        <div class="flex items-center gap-5">
                            <span class="text-sm">{{ Auth::user()->name }}</span>
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img
                                        src="
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
            aaaaaa
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
    @livewire('layout/customer/footer')
    </div>
</body>

</html>