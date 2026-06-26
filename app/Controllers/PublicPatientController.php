<?php
// app/Controllers/PublicPatientController.php

require_once __DIR__ . '/../Services/PatientService.php';

class PublicPatientController
{
    private PatientService $service;

    public function __construct() {
        // Form public nên KHÔNG CÓ require_login() ở đây
        $this->service = new PatientService();
    }

    public function create(): void
    {
        render('public/create', ['title' => 'Đăng ký khám bệnh', 'errors' => []]);
    }

    public function store(): void
    {
        // 1. RATE LIMIT (T09): Chặn spam submit liên tục (5 giây / lần)
        $lastSubmit = $_SESSION['last_submit_time'] ?? 0;
        if (time() - $lastSubmit < 5) {
            flash('error', 'Bạn thao tác quá nhanh. Vui lòng đợi 5 giây rồi thử lại.');
            $_SESSION['old'] = $_POST;
            redirect('/public-patients/create');
        }

        // 2. HONEYPOT (T09): Bẫy Bot tự động điền form
        if (!empty($_POST['website_url'])) {
            // Giả vờ thành công để lừa bot, nhưng thực chất không lưu Database
            flash('success', 'Đăng ký thành công!');
            redirect('/public-patients/create');
        }

        // 3. LƯU DATABASE & BẮT LỖI (T07)
        $result = $this->service->createPatient($_POST);

        if (!$result['success']) {
            $_SESSION['old'] = $_POST;
            render('public/create', ['title' => 'Đăng ký khám bệnh', 'errors' => $result['errors']]);
            return;
        }

        // 4. PRG PATTERN (T08): Lưu thời gian submit và Redirect chống F5
        $_SESSION['last_submit_time'] = time();
        flash('success', 'Đăng ký khám bệnh thành công! Chúng tôi sẽ sớm liên hệ với bạn.');
        redirect('/public-patients/create');
    }
}