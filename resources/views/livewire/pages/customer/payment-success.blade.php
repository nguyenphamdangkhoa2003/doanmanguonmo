<div>
    <div class="card rounded-none bg-neutral border shadow-2xl m-auto my-10 text-neutral-content w-96">
        <div class="card-body items-center text-center">
            <h2 class="card-title text-green-400 font-medium text-xl">Payment Successfull!</h2>
            <div class="avatar py-6">
                <x-mary-icon name="o-check-badge" class="w-20 h-20 border-green-500 text-green-500 p-2 rounded-full" />
            </div>
            <div class="py-4 w-full">
                <div class="flex justify-between">
                    <div class="text-gray-400 text-sm">Payment type</div>
                    <div>{{ session('payment_data.payment_type') }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-gray-400 text-sm">Bank</div>
                    <div>{{ session('payment_data.bank_code') }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-gray-400 text-sm">Mobile</div>
                    <div>{{ session('payment_data.phone') }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-gray-400 text-sm">Email</div>
                    <div>{{ session('payment_data.email') }}</div>
                </div>

                <div class="flex justify-between py-2">
                    <div class="text-gray-400 font-semibold">Amount paid</div>
                    <div class=" font-semibold">{{ number_format(session('payment_data.amount'), 0, '.', ',') }}</div>
                </div>
                <div class="flex justify-between py-2 pb-5">
                    <div class="text-gray-400 text-sm ">Transaction id</div>
                    <div>{{ session('payment_data.transaction_no') }}</div>
                </div>
            </div>
            <div class="card-actions justify-end">
                <button wire:click="paymentSuccess" class=" btn btn-primary">Print</button>
                <button wire:click="paymentSuccess"
                    class="btn hover:bg-green-500 hover:border-none bg-green-400 border-green-400">Close</button>
            </div>
        </div>
    </div>
</div>