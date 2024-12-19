<div class="rounded shadow bg-base-200 p-5">
    <x-mary-steps wire:model="step" class="border my-5 p-5">
        <x-mary-step step="1" text="Confirm User Information">
            <x-mary-form wire:submit="confirmInfoUser">
                <x-mary-input label="Name" wire:model="form.cus_name" icon="o-user" />
                <x-mary-input label="Email" wire:model="form.cus_email" prefix="@" />
                <x-mary-input label="Phone" wire:model="form.cus_phone" />
                <x-mary-input label="Address" wire:model="form.cus_address" icon-right="o-map-pin" />
                <x-slot:actions>
                    <x-mary-button label="Cancel" />
                    <x-mary-button label="Continue" class="btn-primary" type="submit" spinner="confirmInfoUser" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-step>
        <x-mary-step step="2" text="Confirm Type Room Selected">
            @foreach ($selected_type_room as $key => $item)
                        <x-mary-list-item :item="$item">
                            <x-slot:avatar class="w-2/5">
                                @php
                                    $type_room = App\Models\RoomType::find($item['room_type']['id']);
                                    $slides = [];
                                    if (isset($type_room->images)) {
                                        foreach ($type_room->images as $image) {
                                            $slides[] = [
                                                'image' => $image->url,
                                            ];
                                        }
                                    }
                                @endphp
                                <x-mary-carousel :slides="$slides" without-indicators />
                            </x-slot:avatar>
                            <x-slot:value class="text-2xl">
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
                                <x-mary-button icon="o-trash" class="text-red-500" wire:click="deleteTypeRoomSelected({{ $key }})"
                                    spinner />
                            </x-slot:actions>
                        </x-mary-list-item>
            @endforeach
            <div class="flex justify-end mt-3 gap-3">
                <x-mary-button label="Cancel" wire:click="prev" spinner="prev" />
                <x-mary-button label="Continue" class="btn-primary" type="submit" spinner="next" wire:click="next"
                    :disabled="!count($selected_type_room)">
                </x-mary-button>

            </div>
        </x-mary-step>
        <x-mary-step step="3" text="Payment">
            <x-mary-header title="Bill" separator />
            <x-mary-form wire:submit="redirectPayment">
                <x-mary-input label="Total price" readonly wire:model="form.total_price" />
                <x-mary-textarea label="content" readonly wire:model="content" />
                <x-slot:actions>
                    <x-mary-button label="Cancel" wire:click="prev" />
                    <x-mary-button label="Redirect
                        Payment" class="btn-primary" type="submit" spinner="redirectPayment" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-step>
    </x-mary-steps>
</div>