<div>
    <x-mary-header title="Add policy" separator />
    <x-mary-form wire:submit="save" no-separator>
        <x-mary-input label="Polycy type " wire:model="form.policy_type" />
        <x-mary-textarea label="Description" wire:model="form.description" />
        <x-slot:actions>
            <x-mary-button label="Cancel" />
            <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-mary-form>
</div>