<div>
    <x-mary-header title="List message" separator />
    @foreach ($messages as $message)
        <x-mary-list-item :item="$message" link="{{ route('detail-contact-message', ['id' => $message->id]) }}">
            <x-slot:value>
                {{ $message->last_name }}
                @if ($message->is_readed == 0)
                    <x-mary-badge value="New" class="badge-primary" />
                @endif
            </x-slot:value>
            <x-slot:sub-value>
                {{ $message->email }}
            </x-slot:sub-value>
            <x-slot:actions>
                <p>
                    {{ $message->created_at }}
                </p>
                <x-mary-button icon="o-trash" class="text-red-500" wire:click="delete({{ $message->id }})" spinner
                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" wire:key="{{ $message->id }}" />
            </x-slot:actions>
        </x-mary-list-item>
    @endforeach
</div>