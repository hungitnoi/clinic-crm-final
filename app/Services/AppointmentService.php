<?php
// app/Services/AppointmentService.php

require_once __DIR__ . '/../Repositories/AppointmentRepository.php';

class AppointmentService
{
    private AppointmentRepository $repo;

    public function __construct() {
        $this->repo = new AppointmentRepository();
    }

    public function getAppointmentList(array $query): array
    {
        $keyword = trim($query['q'] ?? '');
        $page = max(1, (int)($query['page'] ?? 1));
        $perPage = 10; 
        
        $allowedSortCols = ['id', 'appointment_code', 'appointment_date', 'status'];
        $allowedSortDirs = ['asc', 'desc'];
        
        $sortCol = in_array($query['sort'] ?? '', $allowedSortCols) ? $query['sort'] : 'id';
        $sortDir = in_array(strtolower($query['dir'] ?? ''), $allowedSortDirs) ? strtoupper($query['dir']) : 'DESC';

        $totalItems = $this->repo->countAll($keyword);
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = min($page, $totalPages); 
        $offset = ($page - 1) * $perPage;

        return [
            'appointments' => $this->repo->getPaginated($keyword, $perPage, $offset, $sortCol, $sortDir),
            'keyword' => $keyword,
            'page' => $page,
            'totalPages' => $totalPages,
            'sort' => $sortCol,
            'dir' => strtolower($sortDir)
        ];
    }

    private function validateData(array $input): array
    {
        $errors = [];
        $code = trim($input['appointment_code'] ?? '');
        $name = trim($input['patient_name'] ?? '');
        $phone = trim($input['patient_phone'] ?? '');
        $date = trim($input['appointment_date'] ?? '');
        $status = trim($input['status'] ?? 'pending');
        $notes = trim($input['notes'] ?? '');

        if ($code === '') $errors['appointment_code'] = 'Mã lịch hẹn không được để trống.';
        if ($name === '') $errors['patient_name'] = 'Tên bệnh nhân không được để trống.';
        if ($date === '') $errors['appointment_date'] = 'Ngày hẹn không được để trống.';
        if (!in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $errors['status'] = 'Trạng thái không hợp lệ.';
        }

        return [
            'errors' => $errors,
            'values' => ['appointment_code' => $code, 'patient_name' => $name, 'patient_phone' => $phone, 'appointment_date' => $date, 'status' => $status, 'notes' => $notes]
        ];
    }

    public function createAppointment(array $input): array
    {
        $validation = $this->validateData($input);
        if (!empty($validation['errors'])) return ['success' => false, 'errors' => $validation['errors']];

        try {
            $this->repo->create($validation['values']);
            return ['success' => true, 'errors' => []];
        } catch (DuplicateRecordException $e) {
            return ['success' => false, 'errors' => ['appointment_code' => $e->getMessage()]];
        }
    }

    public function getById(int $id): ?array { return $this->repo->findById($id); }

    public function updateAppointment(int $id, array $input): array
    {
        if (!$this->repo->findById($id)) return ['success' => false, 'errors' => ['general' => 'Không tồn tại.']];
        
        $validation = $this->validateData($input);
        if (!empty($validation['errors'])) return ['success' => false, 'errors' => $validation['errors']];

        try {
            $this->repo->update($id, $validation['values']);
            return ['success' => true, 'errors' => []];
        } catch (DuplicateRecordException $e) {
            return ['success' => false, 'errors' => ['appointment_code' => $e->getMessage()]];
        }
    }

    public function deleteAppointment(int $id): void { $this->repo->delete($id); }
}