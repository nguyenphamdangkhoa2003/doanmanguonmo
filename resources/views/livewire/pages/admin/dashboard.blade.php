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

    </div>


</div>