<div class="shadow border rounded-lg bg-white overflow-hidden max-w-3xl md:mx-auto mx-6 my-6">
    @isset($slides)
        <x-mary-carousel :slides="$slides" class="rounded-none h-[300px]" />
    @endisset
    <div class="p-6">
        <x-mary-header title="About" separator />
        @isset($about_page)
            <div class="pb-5">{!! $about_page->content !!}</div>
        @endisset
    </div>
</div>