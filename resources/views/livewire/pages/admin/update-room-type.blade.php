<div>
    <x-mary-toast />
    <x-mary-header title="Update room type" separator progress-indicator />
    <x-mary-form wire:submit="save">
        <x-mary-input label="Name" wire:model="form.room_type_name" />
        <x-mary-textarea label="Description" wire:model="form.description" rows="5" inline />
        <x-mary-input type="number" wire:model="form.base_price" label="Base price" />
        <x-mary-input type="number" wire:model="form.children" label="Children" />
        <x-mary-input type="number" wire:model="form.adults" label="Adults" />
        <x-mary-file wire:model="photos" label="Documents" accept="image/png, image/jpeg" multiple />
        <x-mary-image-gallery :images="$existingImages" class="h-40 rounded-box" />
        <x-slot:actions>
            <x-mary-button label="Cancel" wire:click="back" spinner="back" />
            <x-mary-button label="Save" icon-right="o-paper-airplane" class="btn-primary" type="submit"
                spinner="save" />
        </x-slot:actions>
    </x-mary-form>
</div>