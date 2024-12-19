<div>
    <x-mary-header title="Detail Booking" />
    <div class="bg-base-300 shadow rounded p-5 mb-10">
        <div class="flex justify-between">
            <div class="font-bold">Customer name:</div>
            <div>
                {{ $booking->cus_name }}
            </div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">Email: </div>
            <div>{{ $booking->cus_email }}</div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">Phone:</div>
            <div>{{ $booking->cus_phone }}</div>
        </div>
        <div class="flex justify-between">
            <div class="font-bold">Address:</div>
            <div>{{ $booking->cus_address }}</div>
        </div>
    </div>

    <div>
        <x-mary-header title="List type room" />
        @foreach ($booking_details as $item)
                @php
                    $room = App\Models\Room::find($item->room_id);
                @endphp
                <x-mary-list-item :item="$room">
                    <x-slot:value>
                        Room Number: {{ $room->room_number }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        <div>
                            Room type: {{ $room->room_type->room_type_name }}
                        </div>
                        <div>
                            Price: {{ $room->room_type->base_price }}
                        </div>
                    </x-slot:sub-value>
                    <x-slot:actions>
                        <div>
                            {{ $item->quantity }}
                        </div>
                    </x-slot:actions>
                </x-mary-list-item>
        @endforeach
        <div class="mt-3 text-xl font-bold">
            Total: {{ $booking->total_price }}
        </div>
    </div>
</div>