<div class="drawer-content w-full mx-auto p-5 lg:px-10 lg:py-5 lg:max-w-4xl">
    <x-mary-header title="Add room type" separator progress-indicator />
    <x-mary-toast />
    <x-mary-form wire:submit="save">
        <x-mary-input label="Name" wire:model="form.room_type_name" />
        <x-mary-textarea label="Description" wire:model="form.description" rows="5" inline />
        <x-mary-input type="number" wire:model="form.base_price" label="Base price" />
        <x-mary-input type="number" wire:model="form.children" label="Children" />
        <x-mary-input type="number" wire:model="form.adults" label="Adults" />
        <x-mary-file type="file" wire:model="photos" wire:key="{{ Auth::user()->id }}" multiple laebl="Photos" />
        <x-slot:actions>
            <x-mary-button label="Cancel" wire:click="back" spinner="back" />
            <x-mary-button label="Save" icon-right="o-paper-airplane" class="btn-primary" type="submit" spinner />
        </x-slot:actions>
    </x-mary-form>
</div>