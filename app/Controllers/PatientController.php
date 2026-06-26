<?php
// app/Controllers/PatientController.php

require_once __DIR__ . '/../Services/PatientService.php';

class PatientController
{
    private PatientService $service;

    public function __construct() {
        require_login(); // Phải đăng nhập mới được xài Controller này
        $this->service = new PatientService();
    }

    public function index(): void
    {
        $data = $this->service->getPatientList($_GET);
        render('patients/index', ['title' => 'Quản lý Bệnh nhân'] + $data);
    }

    public function create(): void
    {
        render('patients/create', ['title' => 'Thêm Bệnh nhân', 'errors' => []]);
    }

    public function store(): void
    {
        $result = $this->service->createPatient($_POST);
        if (!$result['success']) {
            $_SESSION['old'] = $_POST;
            render('patients/create', ['title' => 'Thêm Bệnh nhân', 'errors' => $result['errors']]);
            return;
        }
        
        flash('success', 'Thêm bệnh nhân thành công!');
        redirect('/patients');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $patient = $this->service->getPatientById($id);
        
        if (!$patient) {
            flash('error', 'Không tìm thấy bệnh nhân.');
            redirect('/patients');
        }
        render('patients/edit', ['title' => 'Sửa Bệnh nhân', 'patient' => $patient, 'errors' => []]);
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $result = $this->service->updatePatient($id, $_POST);
        
        if (!$result['success']) {
            $_SESSION['old'] = $_POST;
            $patient = $this->service->getPatientById($id);
            render('patients/edit', ['title' => 'Sửa Bệnh nhân', 'patient' => $patient, 'errors' => $result['errors']]);
            return;
        }
        
        flash('success', 'Cập nhật thành công!');
        redirect('/patients');
    }

    public function delete(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        $this->service->deletePatient($id);
        flash('success', 'Đã xóa bệnh nhân.');
        redirect('/patients');
    }
}