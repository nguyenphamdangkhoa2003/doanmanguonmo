<div>
    <x-mary-toast />
    <main class="mx-auto max-w-3xl m-6">
        <div class="">
            <div class="shadow border rounded-lg bg-white overflow-hidden">
                <div class="">
                    <div class="ifr-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.0771566263015!2d106.61480117507637!3d10.728532389417335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ddd54d7b0f9%3A0x71bb91451324b3db!2zNjcvOCBOZ3V54buFbiBRdcO9IFnDqm0sIEtodSBQaOG7kSA0LCBCw6xuaCBUw6JuLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1733223690501!5m2!1svi!2s"
                            class="w-full" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="p-6 px-10">
                        <div>
                            <p class="font-semibold text-2xl pt-4">Liên hệ</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($contact_page->address) }}"
                                target="_blank" class="text-orange-400 hover:underline py-4">
                                {{ $contact_page->address }}
                            </a>
                        </div>
                        <div class=" border-b py-4">
                            <div>
                                <span>Số điện thoại: </span>
                                <a href="tel:{{ $contact_page->phone }}" class="text-orange-400 hover:underline py-4">
                                    {{ $contact_page->phone }}
                                </a>
                            </div>
                            <div>
                                <span>Địa chỉ email: </span>
                                <a href="mailto:{{ $contact_page->email }}"
                                    class="text-orange-400 hover:underline py-4">
                                    {{ $contact_page->email }}
                                </a>
                            </div>
                        </div>
                        <div class=" border-b py-4">
                            <div>
                                <span>{{ $contact_page->description }}</span>
                            </div>
                        </div>
                        <x-mary-form wire:submit="send">
                            <table class="border-collapse border-spacing-4">
                                <tr>
                                    <td class="p-3">
                                        <x-mary-input wire:model="form.first_name" placeholder="Your first name" />
                                    </td>
                                    <td class="p-3">
                                        <x-mary-input wire:model="form.last_name" placeholder="Your last name" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3">
                                        <x-mary-input wire:model="form.email" placeholder="Your email" />
                                    </td>
                                    <td class="p-3">
                                        <x-mary-input wire:model="form.phone" placeholder="Your phone" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="p-3">
                                        <x-mary-textarea label="Message" wire:model="form.message" rows="5" inline />
                                    </td>
                                </tr>
                            </table>
                            <x-slot:actions>
                                <x-mary-button label="Send" class="btn-primary" type="submit" spinner="send" />
                            </x-slot:actions>
                        </x-mary-form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>