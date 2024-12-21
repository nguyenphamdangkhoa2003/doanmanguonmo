# Hướng dẫn cài đặt và sử dụng

## 1. Cài đặt môi trường

Trước khi có thể chạy ứng dụng, bạn cần chuẩn bị môi trường làm việc. Dưới đây là các bước chi tiết.

### Cài đặt PHP và Composer

Để chạy Laravel, bạn cần PHP (phiên bản 8.0 hoặc mới hơn) và Composer – công cụ quản lý gói cho PHP.

-   **Cài đặt PHP:**

    -   Tải PHP từ [https://www.php.net/downloads](https://www.php.net/downloads).
    -   Nếu dùng hệ điều hành Windows, bạn có thể cài PHP qua **XAMPP** hoặc **Laragon**.

-   **Cài đặt Composer:**
    -   Tải và cài đặt Composer từ [https://getcomposer.org/download/](https://getcomposer.org/download/).
    -   Sau khi cài đặt, kiểm tra phiên bản PHP và Composer bằng lệnh:
        php -v
        composer -v

### Cài đặt MySQL hoặc MariaDB

Laravel yêu cầu cơ sở dữ liệu để lưu trữ dữ liệu ứng dụng.

-   **Cài đặt MySQL:**

    -   Tải và cài đặt MySQL từ [https://dev.mysql.com/downloads/](https://dev.mysql.com/downloads/).
    -   Nếu dùng **XAMPP**, MySQL đã được cài sẵn.

-   **Cài đặt MariaDB:**

    -   MariaDB là hệ quản trị cơ sở dữ liệu thay thế MySQL, tải tại [https://mariadb.org/download/](https://mariadb.org/download/).

-   **Tạo cơ sở dữ liệu:**
    -   Đảm bảo rằng bạn đã tạo một cơ sở dữ liệu, ví dụ tên cơ sở dữ liệu là `hotel_booking`.

---

## 2. Cài đặt Laravel

Sau khi cài đặt PHP, Composer và cơ sở dữ liệu, thực hiện lệnh sau để cài Laravel:

composer create-project --prefer-dist laravel/laravel hotel-booking

Lệnh này sẽ tải xuống và cài đặt Laravel phiên bản mới nhất vào thư mục `hotel-booking`.

---

## 3. Cấu hình tệp `.env`

Laravel sử dụng tệp `.env` để cấu hình môi trường ứng dụng.

-   Mở tệp `.env` trong thư mục gốc của dự án.
-   Cập nhật các dòng sau để kết nối với cơ sở dữ liệu của bạn:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doanthuchangweb
DB_USERNAME=root
DB_PASSWORD=

**Lưu ý:**

-   Nếu dùng **XAMPP** hoặc **Laragon**, tên người dùng mặc định là `root` và mật khẩu để trống.

### Cài đặt các gói yêu cầu

Nếu ứng dụng sử dụng các gói bên ngoài (ví dụ: **Laravel Livewire**), cài đặt chúng bằng lệnh:

composer install

---

## 4. Chạy lệnh Artisan

Sau khi cấu hình xong, sử dụng các lệnh Artisan để chạy ứng dụng:

npm install
php artisan serve
npm run dev

---

## 5. Cài đặt và sử dụng ứng dụng

### Migrate và Seed cơ sở dữ liệu

Ứng dụng cần các bảng dữ liệu. Sử dụng các lệnh sau để tạo và thêm dữ liệu:

-   **Tạo bảng từ migration:**

php artisan migrate

-   **Thêm dữ liệu mẫu (nếu có):**

php artisan db:seed

---
