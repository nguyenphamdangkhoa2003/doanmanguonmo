<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Payment;
use App\Models\RoomType;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    public function vnpay_payment()
    {// Lấy giá trị từ request
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, "IQLL0IAY2R93XA22VBHYP3PJTO8WJI37");
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                try {
                    DB::transaction(function () use ($inputData) {
                        // Lấy thông tin booking dates từ session
                        $booking_dates = session()->get("booking_dates");

                        // Tạo booking
                        $booking_info = Booking::create([
                            "cus_name" => Auth::user()->name,
                            "cus_email" => Auth::user()->email,
                            "cus_phone" => Auth::user()->phone,
                            "cus_address" => Auth::user()->address,
                            "total_price" => session()->get("total_price"),
                            "user_id" => Auth::user()->id,
                            "status" => "pending",
                        ]);

                        // Tạo payment
                        Payment::create([
                            "payment_type" => $inputData["vnp_CardType"],
                            "amount" => session()->get("total_price"),
                            "payment_date" => \DateTime::createFromFormat('YmdHis', $inputData["vnp_PayDate"])->format('Y-m-d'),
                            "booking_id" => $booking_info->id,
                        ]);

                        // Lấy danh sách loại phòng được chọn
                        $selected_type_room = session()->get("selected_type_room");

                        foreach ($selected_type_room as $value) {
                            $room_Type = RoomType::find($value["room_type"]["id"]);

                            // Lấy danh sách phòng trống của loại phòng
                            $available_rooms = $room_Type->rooms()->get()->filter(function ($room) use ($booking_dates) {
                                return $room->is_available($booking_dates["start_date"], $booking_dates["end_date"]);
                            });

                            // Kiểm tra nếu số lượng phòng trống không đủ
                            if ($available_rooms->count() < $value["count"]) {
                                throw new \Exception("Không đủ phòng trống cho loại phòng ID: {$room_Type->id}");
                            }

                            // Tạo chi tiết booking cho từng phòng
                            $selected_rooms = $available_rooms->take($value["count"]);
                            foreach ($selected_rooms as $room) {
                                BookingDetail::create([
                                    "quantity" => 1, // Mỗi phòng chỉ đếm 1 lần đặt
                                    "booking_id" => $booking_info->id,
                                    "room_id" => $room->id,
                                    "base_price" => $room_Type->base_price,
                                    "check_in" => $booking_dates["start_date"],
                                    "check_out" => $booking_dates["end_date"],
                                ]);
                            }
                        }

                        // Chuẩn bị dữ liệu thanh toán
                        $payment_data = [
                            "payment_type" => $inputData["vnp_CardType"],
                            "bank_code" => $inputData["vnp_BankCode"],
                            "phone" => Auth::user()->phone,
                            "email" => Auth::user()->email,
                            "amount" => session()->get("total_price"),
                            "transaction_no" => $inputData["vnp_TransactionNo"],
                        ];
                        session()->put("payment_data", $payment_data);

                        // Xóa thông tin khỏi session sau khi xử lý
                        session()->forget(["total_price", "selected_type_room", "booking_dates"]);
                    });


                    // Chuyển hướng tới trang thành công
                    return view("PaymentSuccess");
                } catch (\Exception $e) {
                    // Xử lý lỗi khi rollback
                    return back()->withErrors(['error' => $e->getMessage()]);
                }
            } else {
                echo "GD Không thành công";
            }
        } else {
            echo "Chữ ký không hợp lệ";
        }

    }
}