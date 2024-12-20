<div>
    <x-mary-avatar placeholder="{{ substr($message->last_name, 0, 1) }}" title="{{ $message->last_name }}"
        subtitle="<{{ $message->email }}>" class="!w-10" />
    <x-mary-menu-separator />
    <div>
        {{ $message->message }}
    </div>
</div>