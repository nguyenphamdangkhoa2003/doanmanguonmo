<div>
    <x-mary-header title="Policies" separator>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" wire:click="redirectAddPolicy" />
        </x-slot:actions>
    </x-mary-header>
    <x-mary-table :headers="$headers" :rows="$policies" striped>
        @scope('cell_action', $policy)
        <x-mary-button icon="o-trash" wire:click.prevent="delete({{ $policy->id }})" spinner class="btn-sm text-red-400"
            wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
        <x-mary-button icon="o-pencil" wire:click.prevent="redirectUpdatePolicy({{ $policy->id }})" spinner
            class="btn-sm" wire:key="{{ $policy->id }}" />
        @endscope
    </x-mary-table>
</div>