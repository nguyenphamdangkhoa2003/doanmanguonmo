<div>
    <x-mary-header title="List Room" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." wire:model.live="search" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-mary-header>
    {{-- TOAST --}}
    <x-mary-toast class=" w-full!" />
    <x-mary-table :headers="$headers" :rows="$rooms" :sort-by="$sortBy" with-pagination>
        @scope('cell_action', $room)
        <x-mary-button icon="o-trash" wire:click.prevent="delete({{ $room->id }})" spinner class="btn-sm text-red-400"
            wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
        <x-mary-button icon="o-pencil" spinner class="btn-sm" wire:key="{{ $room->id }}" />
        <x-mary-button icon="s-chevron-right" spinner class="btn-sm" wire:key="{{ $room->id }}" />
        @endscope
    </x-mary-table>
</div>