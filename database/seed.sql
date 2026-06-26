
-- database/seed.sql
USE clinic_crm;

-- Mật khẩu demo là: 123456
INSERT INTO users (name, email, password_hash, role)
VALUES
('Admin User', 'admin@clinic.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Dữ liệu giả cho bảng patients (21 dòng)
INSERT INTO patients (full_name, email, phone, gender, address) VALUES
('Nguyễn Văn An', 'an.nguyen@example.com', '0901234561', 'male', 'Quận 1, TP.HCM'),
('Trần Thị Bình', 'binh.tran@example.com', '0901234562', 'female', 'Quận 2, TP.HCM'),
('Lê Hoàng Cường', 'cuong.le@example.com', '0901234563', 'male', 'Quận 3, TP.HCM'),
('Phạm Thị Dung', 'dung.pham@example.com', '0901234564', 'female', 'Quận 4, TP.HCM'),
('Hoàng Văn Em', 'em.hoang@example.com', '0901234565', 'male', 'Quận 5, TP.HCM'),
('Đỗ Thị Phương', 'phuong.do@example.com', '0901234566', 'female', 'Quận 6, TP.HCM'),
('Vũ Đức Giang', 'giang.vu@example.com', '0901234567', 'male', 'Quận 7, TP.HCM'),
('Ngô Thị Hạnh', 'hanh.ngo@example.com', '0901234568', 'female', 'Quận 8, TP.HCM'),
('Lý Công Ích', 'ich.ly@example.com', '0901234569', 'male', 'Quận 9, TP.HCM'),
('Bùi Thị Khuyên', 'khuyen.bui@example.com', '0901234570', 'female', 'Quận 10, TP.HCM'),
('Hồ Minh Lân', 'lan.ho@example.com', '0901234571', 'male', 'Quận 11, TP.HCM'),
('Châu Thị Mai', 'mai.chau@example.com', '0901234572', 'female', 'Quận 12, TP.HCM'),
('Đặng Văn Nam', 'nam.dang@example.com', '0901234573', 'male', 'Bình Thạnh, TP.HCM'),
('Phan Thị Oanh', 'oanh.phan@example.com', '0901234574', 'female', 'Gò Vấp, TP.HCM'),
('Cao Trọng Phong', 'phong.cao@example.com', '0901234575', 'male', 'Tân Bình, TP.HCM'),
('Đinh Thị Quỳnh', 'quynh.dinh@example.com', '0901234576', 'female', 'Tân Phú, TP.HCM'),
('Trịnh Minh Sang', 'sang.trinh@example.com', '0901234577', 'male', 'Phú Nhuận, TP.HCM'),
('Đoàn Thị Trang', 'trang.doan@example.com', '0901234578', 'female', 'Bình Tân, TP.HCM'),
('Lâm Tuấn Uy', 'uy.lam@example.com', '0901234579', 'male', 'Thủ Đức, TP.HCM'),
('Tôn Nữ Vân', 'van.ton@example.com', '0901234580', 'female', 'Nhà Bè, TP.HCM'),
('Lương Kế Xuân', 'xuan.luong@example.com', '0901234581', 'male', 'Hóc Môn, TP.HCM');

-- Dữ liệu giả cho bảng appointments (21 dòng)
INSERT INTO appointments (appointment_code, patient_name, patient_phone, appointment_date, status, notes) VALUES
('APP-26-0001', 'Nguyễn Văn An', '0901234561', '2026-07-01 08:00:00', 'completed', 'Khám tổng quát'),
('APP-26-0002', 'Trần Thị Bình', '0901234562', '2026-07-01 09:30:00', 'completed', 'Đau dạ dày'),
('APP-26-0003', 'Lê Hoàng Cường', '0901234563', '2026-07-02 08:15:00', 'confirmed', 'Kiểm tra huyết áp'),
('APP-26-0004', 'Phạm Thị Dung', '0901234564', '2026-07-02 10:00:00', 'cancelled', 'Khách bận'),
('APP-26-0005', 'Hoàng Văn Em', '0901234565', '2026-07-03 13:30:00', 'pending', 'Khám mắt'),
('APP-26-0006', 'Đỗ Thị Phương', '0901234566', '2026-07-03 14:00:00', 'confirmed', 'Tái khám'),
('APP-26-0007', 'Vũ Đức Giang', '0901234567', '2026-07-04 09:00:00', 'pending', 'Nhổ răng khôn'),
('APP-26-0008', 'Ngô Thị Hạnh', '0901234568', '2026-07-04 10:30:00', 'confirmed', 'Tư vấn dinh dưỡng'),
('APP-26-0009', 'Lý Công Ích', '0901234569', '2026-07-05 08:45:00', 'pending', 'Lấy cao răng'),
('APP-26-0010', 'Bùi Thị Khuyên', '0901234570', '2026-07-05 11:00:00', 'confirmed', 'Khám tai mũi họng'),
('APP-26-0011', 'Hồ Minh Lân', '0901234571', '2026-07-06 14:30:00', 'pending', 'Khám sức khỏe xin việc'),
('APP-26-0012', 'Châu Thị Mai', '0901234572', '2026-07-06 15:00:00', 'confirmed', 'Đau đầu kéo dài'),
('APP-26-0013', 'Đặng Văn Nam', '0901234573', '2026-07-07 08:30:00', 'pending', 'Dị ứng ngoài da'),
('APP-26-0014', 'Phan Thị Oanh', '0901234574', '2026-07-07 09:45:00', 'confirmed', 'Đau nhức xương khớp'),
('APP-26-0015', 'Cao Trọng Phong', '0901234575', '2026-07-08 13:00:00', 'pending', 'Khám nam khoa'),
('APP-26-0016', 'Đinh Thị Quỳnh', '0901234576', '2026-07-08 14:15:00', 'confirmed', 'Khám phụ khoa'),
('APP-26-0017', 'Trịnh Minh Sang', '0901234577', '2026-07-09 10:00:00', 'pending', 'Kiểm tra đường huyết'),
('APP-26-0018', 'Đoàn Thị Trang', '0901234578', '2026-07-09 11:30:00', 'confirmed', 'Tư vấn nha khoa'),
('APP-26-0019', 'Lâm Tuấn Uy', '0901234579', '2026-07-10 08:00:00', 'pending', 'Đau thắt ngực'),
('APP-26-0020', 'Tôn Nữ Vân', '0901234580', '2026-07-10 09:15:00', 'confirmed', 'Khám da liễu'),
('APP-26-0021', 'Lương Kế Xuân', '0901234581', '2026-07-11 15:30:00', 'pending', 'Tái khám định kỳ');