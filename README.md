# Clinic Appointment CRM (PHP Secure MVC)

Mini Project cuối kỳ - Hệ thống quản lý Phòng khám (Biến thể từ bài Lead & Order).
- **Sinh viên thực hiện:** Lê Kim Hùng
- **MSSV:** 22110068
- **Lớp:** Data Science (Khoa Toán - Tin học, HCMUS)

## Các tính năng bảo mật đã triển khai:
- [x] Front Controller (`public/index.php`) & Custom Router (404, 405).
- [x] PDO Prepared Statements (Chống SQL Injection).
- [x] PRG Pattern (Post/Redirect/Get) chống resubmit form.
- [x] Honeypot & Rate Limit chống Spam (tại Public Form).
- [x] `session_regenerate_id(true)`, HttpOnly, SameSite cookie flags.
- [x] Sắp xếp (Sort) an toàn bằng Whitelist.

## Cấu trúc thư mục MVC
Dự án sử dụng Controller mỏng, đẩy logic vào Service và truy vấn Database vào Repository.

## Hướng dẫn cài đặt & chạy project
1. Clone repository này về máy.
2. Mở phpMyAdmin (hoặc MySQL Workbench), chạy lần lượt 2 file:
   - `database/schema.sql` (Tạo bảng)
   - `database/seed.sql` (Tạo dữ liệu mẫu)
3. Mở terminal tại thư mục gốc của project và chạy server PHP:
   ```bash
   php -S localhost:8000 -t public