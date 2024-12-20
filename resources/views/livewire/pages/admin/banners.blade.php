<div>
    <x-mary-header title="Banners" separator progress-indicator />
    <div>
        <x-mary-file wire:model="photos" multiple />
    </div>
    <div class="flex gap-3 flex-wrap my-3">
        @foreach ($photos as $key => $photo)
            <div class="card bg-base-100 image-full w-96 shadow-xl">
                <figure>
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" />
                </figure>
                <div class="card-body">
                    <div class="card-actions justify-end">
                        <x-mary-button icon="o-trash" wire:click.prevent="deleteSelected({{ $key }})" spinner
                            class="btn-sm text-red-400"
                            wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-mary-button label="Save" icon-right="o-paper-airplane" class="btn-primary" spinner wire:click="save" />
    <div class="flex gap-3 flex-wrap my-3">
        @if (isset($images))
            @foreach ($images as $image)
                <div class="card bg-base-100 image-full w-96 shadow-xl">
                    <figure>
                        <img src="{{ $image->url }}" alt="Preview" />
                    </figure>
                    <div class="card-body">
                        <div class="card-actions justify-end">
                            <x-mary-button icon="o-trash" wire:click.prevent="delete({{ $image->id }})" spinner
                                class="btn-sm text-red-400"
                                wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>