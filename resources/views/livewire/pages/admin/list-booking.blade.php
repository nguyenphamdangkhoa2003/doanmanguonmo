<div>
    <x-mary-header title="List booking" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-bolt" placeholder="Search..." wire:model.live="search" />
        </x-slot:middle>
    </x-mary-header>
    {{-- TOAST --}}
    <x-mary-toast class="w-full!" />
    <x-mary-table :headers="$headers" :rows="$bookings" :sort-by="$sortBy" with-pagination>
        @scope('cell_status', $booking)
        @if ($booking->status == 'pending')
            <x-mary-badge value="Pending" class="bg-orange-300" />
        @elseif ($booking->status == 'confirm')
            <x-mary-badge value="Confirm" class="bg-green-300" />
        @else
            <x-mary-badge value="Cancel" class="bg-red-300" />
        @endif
        @endscope
        @scope('cell_action', $booking)
        <x-mary-button icon="c-check" wire:click.prevent="approve({{ $booking->id }})" spinner class="btn-sm" />
        <x-mary-button icon="o-x-circle" wire:click.prevent="delete({{ $booking->id }})" spinner class="btn-sm"
            wire:key="{{ $booking->id }}" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
        <x-mary-button icon="o-chevron-right" wire:click.prevent="detail({{ $booking->id }})" spinner class="btn-sm" />
        @endscope
    </x-mary-table>
</div>