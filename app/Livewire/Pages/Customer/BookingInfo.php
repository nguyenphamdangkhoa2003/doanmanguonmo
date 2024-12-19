<?php

namespace App\Livewire\Pages\Customer;

use App\Livewire\Forms\BookingForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("layouts.app")]
class BookingInfo extends Component
{

    public int $step = 1;
    public $selected_type_room = [];
    public BookingForm $form;
    public $content;
    public function render()
    {
        $user = Auth::user();
        $this->form->cus_address = $user->address;
        $this->form->cus_email = $user->email;
        $this->form->cus_name = $user->name;
        $this->form->cus_phone = $user->phone;
        $this->form->total_price = session()->get("total_price", 0);
        $this->selected_type_room = session()->get("selected_type_room", []);
        $this->content = "Giao dich cua khach hang co id " . Auth::user()->id . ", So tien " . $this->form->total_price;
        return view('livewire.pages.customer.booking-info');
    }
    public function confirmInfoUser()
    {
        $this->form->validate();
        $this->next();
    }
    public function next()
    {
        if ($this->step + 1 > 3) {
            $this->step = 2;
        } else {
            $this->step += 1;
        }
    }

    public function prev()
    {
        if ($this->step - 1 < 1) {
            $this->step = 1;
        } else {
            $this->step -= 1;

        }
    }
    public function deleteTypeRoomSelected($key)
    {
        $total_price = $this->selected_type_room[$key]["total_price"];
        unset($this->selected_type_room[$key]);
        session()->put("selected_type_room", $this->selected_type_room);
        $old_total_price = session()->get("total_price");
        session()->put("total_price", $old_total_price - $total_price);
    }
    public function redirectPayment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route("vnpay_php");
        $vnp_TmnCode = "0LJFR2YO";//Mã website tại VNPAY 
        $vnp_HashSecret = "IQLL0IAY2R93XA22VBHYP3PJTO8WJI37"; //Chuỗi bí mật

        $vnp_TxnRef = $this->generateTxnRef(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này  sang VNP
        $vnp_OrderInfo = $this->content;
        $vnp_OrderType = "BookingRoom";
        $vnp_Amount = $this->form->total_price * 100;
        $vnp_Locale = "VN";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_BankCode" => "NCB"
        );
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        $this->redirect($vnp_Url);
        // vui lòng tham khảo thêm tại code demo
    }

    function generateTxnRef()
    {
        return time() . mt_rand(1000, 9999); // Thời gian hiện tại kết hợp với số ngẫu nhiên
    }
}
