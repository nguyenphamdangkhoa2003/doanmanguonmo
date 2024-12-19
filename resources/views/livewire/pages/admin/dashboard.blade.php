<div>
    <x-mary-header title="Dashboard" separator />
    <div class="grid grid-cols-4 gap-5">
        <a href="{{route('list-user')}}" class="link no-underline hover:shadow-lg">
            <x-mary-card class=" bg-white rounded-none shadow border h-32" separator progress-indicator>
                <div class="flex p-5 gap-3">
                    <x-mary-icon name="s-user" class="w-12 h-12 bg-slate-200 text-blue-300 p-2 rounded-full" />
                    <div>
                        <div class="font-extrabold pb-1">
                            {{$userCount}}
                        </div>
                        <div class="text-slate-300 font-extrabold text-sm">
                            Users
                        </div>
                    </div>
                </div>
            </x-mary-card>
        </a>
        <a href="{{route('list-booking')}}" class="link no-underline hover:shadow-lg">
            <x-mary-card class="bg-white rounded-none shadow border h-32" separator progress-indicator>
                <div class="flex p-5 gap-3">
                    <x-mary-icon name="s-clipboard-document-check"
                        class="w-12 h-12 bg-slate-200 text-blue-700 p-2 rounded-full" />
                    <div>
                        <div class="font-extrabold pb-1">
                            {{$bookingCount}}
                        </div>
                        <div class="text-slate-300 font-extrabold text-sm">
                            Bookings
                        </div>
                    </div>
                </div>
            </x-mary-card>
        </a>
        <a class="link no-underline hover:shadow-lg">
            <x-mary-card class="bg-white rounded-none shadow border h-32" separator progress-indicator>
                <div class="flex p-5 gap-3">
                    <x-mary-icon name="s-banknotes" class="w-12 h-12 bg-slate-200 text-orange-500 p-2 rounded-full" />
                    <div>
                        <div class="font-extrabold pb-1">
                            {{number_format($totalPaymentCount, 0, '.', ',')}}
                        </div>
                        <div class="text-slate-300 font-extrabold text-sm">
                            Money
                        </div>
                    </div>
                </div>
            </x-mary-card>
        </a>
        <a href="{{route('list-room')}}" class="link no-underline hover:shadow-lg">
            <x-mary-card class="bg-white rounded-none shadow border h-32" separator progress-indicator>
                <div class="flex p-5 gap-3">
                    <x-mary-icon name="s-home-modern" class="w-12 h-12 bg-slate-200 text-green-500 p-2 rounded-full" />
                    <div>
                        <div class="font-extrabold pb-1">
                            {{$roomCount}}
                        </div>
                        <div class="text-slate-300 font-extrabold text-sm">
                            Room
                        </div>
                    </div>
                </div>
            </x-mary-card>
        </a>
    </div>
    <div class="grid grid-cols-4 gap-5">
        <div class="col-span-3">
            <div class="bg-white shadow my-5 p-5">
                <h3 class="text-2xl font-extrabold">Revenue</h3>
                <x-mary-chart wire:model="revent_chart" />
            </div>
            <div class="bg-white shadow p-5">
                <h3>User register</h3>
                <x-mary-chart wire:model="user_chart" />
            </div>
        </div>
        <div class="col-span-1">

            <div class="bg-white shadow p-5">
                <h3 class="text-2xl font-extrabold">Rooms</h3>
                <hr>
                <x-mary-chart class="w-52" wire:model="rooms_chart" />
            </div>
        </div>
    </div>


</div>