<?php

namespace App\Livewire\Pages\Customer;

use Livewire\Component;

class PaymentSuccess extends Component
{
    public function paymentSuccess()
    {
        // Kiểm tra và lấy dữ liệu từ session
        if (session()->has('payment_data')) {
            $paymentData = session('payment_data');

            // Xoá session sau khi lấy dữ liệu
            session()->forget('payment_data');

            // Trả về view với dữ liệu
            return redirect()->route('home');
        }

        // Nếu không có dữ liệu trong session, điều hướng về trang chủ
        return redirect()->route('home')->with('error', 'No payment data found.');
    }
    public function render()
    {
        return view('livewire.pages.customer.payment-success');
    }
}
