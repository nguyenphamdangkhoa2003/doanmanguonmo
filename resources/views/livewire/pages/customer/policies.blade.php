<div>
    <main class="mx-auto max-w-3xl">
        <div class="py-6">
            <div class="shadow border rounded-lg bg-white overflow-hidden">
                <div class="">
                    <div class="p-6 px-10">
                        <div>
                            <p class="font-semibold text-3xl pt-4">Terms, conditions and privacy policy</p>
                        </div>
                        <div class="py-4">
                            @isset($policies)
                                @foreach ($policies as $policy)
                                    <div class="text-lg">
                                        <p class="py-3">{{ $policy->policy_type }}</p>
                                        <div class="list-disc pl-5 space-y-2 text-sm">
                                            {!! $policy->description !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>