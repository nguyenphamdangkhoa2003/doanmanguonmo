<div>
    <x-mary-header title="List Type Room" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." wire:model.live="search" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" wire:click="redirectAddTypeRoom" />
        </x-slot:actions>
    </x-mary-header>
    {{-- TOAST --}}
    <x-mary-toast class="w-full!" />
    <x-mary-table :headers="$headers" :rows="$room_types" :sort-by="$sortBy" with-pagination>
        @scope('cell_action', $room_type)
        <x-mary-button icon="o-trash" wire:click.prevent="delete({{ $room_type->id }})" spinner
            class="btn-sm text-red-400" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
            wire:key="{{ $room_type->id }}" />
        <x-mary-button icon="o-pencil" wire:click.prevent="redirectUpdateTypeRoom({{ $room_type->id }})" spinner
            class="btn-sm" wire:key="{{ $room_type->id }}" />
        @endscope </x-mary-table>
</div>