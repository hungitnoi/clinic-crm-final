<?php
// app/Controllers/AppointmentController.php

require_once __DIR__ . '/../Services/AppointmentService.php';

class AppointmentController
{
    private AppointmentService $service;

    public function __construct() {
        require_login();
        $this->service = new AppointmentService();
    }

    public function index(): void {
        $data = $this->service->getAppointmentList($_GET);
        render('appointments/index', ['title' => 'Quản lý Lịch hẹn'] + $data);
    }

    public function create(): void { render('appointments/create', ['title' => 'Thêm Lịch hẹn', 'errors' => []]); }

    public function store(): void {
        $result = $this->service->createAppointment($_POST);
        if (!$result['success']) {
            $_SESSION['old'] = $_POST;
            render('appointments/create', ['title' => 'Thêm Lịch hẹn', 'errors' => $result['errors']]);
            return;
        }
        flash('success', 'Thêm lịch hẹn thành công!');
        redirect('/appointments');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $appt = $this->service->getById($id);
        if (!$appt) { flash('error', 'Không tìm thấy.'); redirect('/appointments'); }
        render('appointments/edit', ['title' => 'Sửa Lịch hẹn', 'appt' => $appt, 'errors' => []]);
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $result = $this->service->updateAppointment($id, $_POST);
        if (!$result['success']) {
            $_SESSION['old'] = $_POST;
            render('appointments/edit', ['title' => 'Sửa Lịch hẹn', 'appt' => $this->service->getById($id), 'errors' => $result['errors']]);
            return;
        }
        flash('success', 'Cập nhật thành công!');
        redirect('/appointments');
    }

    public function delete(): void {
        $this->service->deleteAppointment((int)($_POST['id'] ?? 0));
        flash('success', 'Đã xóa lịch hẹn.');
        redirect('/appointments');
    }
}