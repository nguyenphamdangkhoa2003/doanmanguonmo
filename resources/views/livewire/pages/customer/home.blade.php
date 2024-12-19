<div>
    <div>
        <div class="md:h-auto pb-4">
            <div class="sm:min-w-full">
                <div class="relative overflow-hidden">
                    <div class="h-64 md:h-[350px] w-full bg-cover bg-center"
                        style="background-image: url('https://www.sixsensescondao.com/wp-content/uploads/2020/12/resized_SixSenses_ConDao_OceanVilla_David-Mitchener_Architecture-Interiors-Photography-Category-scaled.jpg');">
                    </div>
                </div>
                <div
                    class="w-full md:max-w-7xl m-auto mx-6 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 md:absolute rounded-md border-primary border-2">
                    <div class="flex justify-evenly items-center bg-base-100 p-3 shadow-md rounded">
                        <x-mary-datetime label="Start date" wire:model.live="start_date" icon="o-calendar" />
                        <x-mary-datetime label="End date" wire:model.live="end_date" />
                        <x-mary-input type="number" label="Adults" wire:model.live="adults" min="1" />
                        <x-mary-input type="number" label="Children" wire:model.live="children" min="0" />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section aria-labelledby="products-heading" class="pb-10 pt-6">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-6 relative">
                        <!-- ===== -->
                        <!-- Product grid -->
                        <div class="lg:col-span-4">
                            <x-mary-progress class="progress-primary h-0.5" indeterminate wire:loading />
                            <div class="flex flex-col gap-5">
                                @if (isset($type_rooms))
                                    @foreach ($type_rooms as $type_room)
                                        <div class="rounded-xl bg-base-100 shadow-xl w-full">
                                            @php
                                                $slides = [];
                                               
                                                if (isset($type_room->images)) {
                                                    foreach ($type_room->images as $image) {
                                                        $slides[] = [
                                                            'image' => $image->url,
                                                        ];
                                                    }
                                                }
                                            @endphp
                                                <div class="card card-side bg-base-100 shadow-xl grid grid-cols-5 items-stretch">
                                                    <div class="col-span-2">
                                                        <figure class="h-full">
                                                            <x-mary-carousel class="rounded-none rounded-tl-xl rounded-bl-xl h-full w-full" :slides="$slides"
                                                                without-indicators />
                                                        </figure>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <div class="card-body p-5 h-full">
                                                            <h2 class="card-title">{{ $type_room->room_type_name }}</h2>
                                                            <p class="text-primary font-medium py-0 my-0">
                                                                            VND
                                                                            @php
                                                                                echo $this->formatCurrencyVND(
                                                                                    $type_room->base_price,
                                                                                );
                                                                            @endphp
                                                                        </p>
                                                            <p class="text-sm text-gray-400 truncate max-w-sm">{{ $type_room->description }}</p>
                                                            <div class="flex flex-col justify-between">
                                                                    <div class="flex gap-1 items-center">
                                                                        <x-mary-icon name="o-user" class="" />
                                                                        @php
                                                                        echo $type_room->adults;
                                                                        @endphp  <span  class="pr-1 border-r">Adults</span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#000000" viewBox="0 0 256 256"><path d="M92,140a12,12,0,1,1,12-12A12,12,0,0,1,92,140Zm72-24a12,12,0,1,0,12,12A12,12,0,0,0,164,116Zm-12.27,45.23a45,45,0,0,1-47.46,0,8,8,0,0,0-8.54,13.54,61,61,0,0,0,64.54,0,8,8,0,0,0-8.54-13.54ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88.11,88.11,0,0,0-84.09-87.91C120.32,56.38,120,71.88,120,72a8,8,0,0,0,16,0,8,8,0,0,1,16,0,24,24,0,0,1-48,0c0-.73.13-14.3,8.46-30.63A88,88,0,1,0,216,128Z"></path></svg>
                                                                        @php
                                                                        echo $type_room->children;
                                                                        @endphp Childrens
                                                                    </div>
                                                                    <div class="flex text-green-600 font-semibold">
                                                                        avalilable
                                                                    </div>
                                                            </div>
                                                            <div class="card-actions justify-end w-full">
                                                                <x-mary-form class="!gap-0 w-full"
                                                                    wire:submit="selected({{ $type_room->id }})">
                                                                   
                                                                    <x-slot:actions>
                                                                
                                                                        <div class="flex items-center gap-2 justify-end">
                                                                        <label class="font-semibold text-sm">Amount</label>
                                                                        <x-mary-input class="pl-1 py-0" type="number" min="1"
                                                                            wire:model.defer="roomCount.{{ $type_room->id }}" />
                                                                    </div>
                                                                        @if (!collect($this->selected_type_room)->contains(fn($item) => $item['room_type']['id'] == $type_room->id))
                                                                            <x-mary-button class="btn btn-primary" type="submit" spinner>
                                                                                SELECT</x-mary-button>
                                                                        @else
                                                                            <div
                                                                                class="bg-green-200 text-green-700 w-fit p-1 rounded shadow-sm">
                                                                                You selected
                                                                            </div>
                                                                        @endif
                                                                    </x-slot:actions>
                                                                </x-mary-form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- cart booking -->
                        <div class="lg:col-span-2 relative">
                            <x-mary-card subtitle="{{ $start_date }} Đến {{ $end_date }}" separator
                                progress-indicator="selected" class="border rounded shadow">
                                @isset($selected_type_room)
                                    @foreach ($selected_type_room as $key => $item)
                                        <x-mary-list-item :item="$item">
                                            <x-slot:value>
                                                {{ $item['room_type']['room_type_name'] }}
                                            </x-slot:value>
                                            <x-slot:sub-value>
                                                <div>
                                                    {{ $item['room_type']['description'] }}
                                                </div>
                                                <div>
                                                    x{{ $item['count'] }}
                                                </div>
                                            </x-slot:sub-value>
                                            <x-slot:actions>
                                                <x-mary-button icon="o-trash" class="text-red-500"
                                                    wire:click="deleteTypeRoomSelected({{ $key }})" spinner />
                                            </x-slot:actions>
                                        </x-mary-list-item>
                                    @endforeach
                                    <div class="flex justify-between">
                                        <div class="text-xl font-semibold">Total: </div>
                                        <div class="text-xl">
                                            @php
                                                echo $this->formatCurrencyVND($this->getTotalPrice());
                                            @endphp
                                        </div>
                                    </div>
                                @endisset
                                <x-slot:actions>
                                    @if (count($selected_type_room) <= 0)
                                        <x-mary-button label="Book" class="btn-primary w-full" disabled="disabled" />
                                    @else
                                        <x-mary-button label="Book" wire:click="redirectBookingPage"
                                            class="btn-primary w-full" spinner />
                                    @endif
                                </x-slot:actions>
                            </x-mary-card>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
