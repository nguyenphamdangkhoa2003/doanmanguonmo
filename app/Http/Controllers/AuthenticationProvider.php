<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationProvider extends Controller
{
    public function redirect_provider()
    {
        return Socialite::driver("google")->redirect();
    }
    public function authentication_callback()
    {
        $google_user = Socialite::driver("google")->user();

        // Kiểm tra xem tài khoản có Google ID đã tồn tại hay chưa
        $user = User::where("google_id", $google_user->getId())->first();

        if ($user) {
            // Người dùng đã đăng nhập bằng Google trước đó
            Auth::login($user);
            return redirect()->route("home");
        }

        // Kiểm tra nếu email đã tồn tại nhưng chưa liên kết với Google ID
        $user = User::where("email", $google_user->getEmail())->first();

        if ($user) {
            // Cập nhật Google ID cho tài khoản đã tồn tại
            $user->update([
                "google_id" => $google_user->getId(),
            ]);
        } else {
            // Tạo tài khoản mới
            $user = User::create([
                "name" => $google_user->getName(),
                "email" => $google_user->getEmail(),
                "password" => Hash::make("P@ssword123"), // Mật khẩu mặc định
                "google_id" => $google_user->getId(),
                "email_verified_at" => \Carbon\Carbon::now(),
            ]);
            // Upload avatar lên Cloudinary
            $cloudinary = cloudinary()->upload($google_user->getAvatar());
            // Lưu thông tin ảnh vào bảng images
            Image::create([
                "url" => $cloudinary->getSecurePath(),
                "public_image_id" => $cloudinary->getPublicId(),
                "user_id" => $user->id,
            ]);
        }

        // Đăng nhập người dùng
        Auth::login($user);
        return redirect()->route("home");
    }
}
