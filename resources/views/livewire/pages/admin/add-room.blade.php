<div>
    <x-mary-header title="Add room" separator progress-indicator />
    <x-mary-toast />
    <x-mary-form wire:submit="save">
        <x-mary-input label="Room Number" wire:model="form.room_number" />
        <x-mary-select label="Type" :options="$room_types" option-value="id" option-label="room_type_name"
            placeholder="Room type" wire:model="form.room_type_id" />
        <x-slot:actions>
            <x-mary-button label="Cancel" wire:click="back" spinner="back" />
            <x-mary-button label="Save" icon-right="o-paper-airplane" class="btn-primary" type="submit"
                spinner="save" />
        </x-slot:actions>
    </x-mary-form>
</div>