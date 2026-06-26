<?php
// app/Services/PatientService.php

require_once __DIR__ . '/../Repositories/PatientRepository.php';

class PatientService
{
    private PatientRepository $repo;

    public function __construct() {
        $this->repo = new PatientRepository();
    }

    public function getPatientList(array $query): array
    {
        $keyword = trim($query['q'] ?? '');
        $page = max(1, (int)($query['page'] ?? 1));
        $perPage = 10; 
        
        $allowedSortCols = ['id', 'full_name', 'created_at'];
        $allowedSortDirs = ['asc', 'desc'];
        
        // Đã đổi mặc định thành sort theo 'id' và hướng 'ASC' (tăng dần 1 -> 23)
        $sortCol = in_array($query['sort'] ?? '', $allowedSortCols) ? $query['sort'] : 'id';
        $sortDir = in_array(strtolower($query['dir'] ?? ''), $allowedSortDirs) ? strtoupper($query['dir']) : 'ASC';

        $totalItems = $this->repo->countAll($keyword);
        $totalPages = max(1, (int)ceil($totalItems / $perPage));
        $page = min($page, $totalPages); 
        $offset = ($page - 1) * $perPage;

        return [
            'patients' => $this->repo->getPaginated($keyword, $perPage, $offset, $sortCol, $sortDir),
            'keyword' => $keyword,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'sort' => $sortCol,
            'dir' => strtolower($sortDir)
        ];
    }

    private function validatePatientData(array $input): array
    {
        $errors = [];
        $fullName = trim($input['full_name'] ?? '');
        $email = trim($input['email'] ?? '');
        $phone = trim($input['phone'] ?? '');
        $gender = trim($input['gender'] ?? 'other');
        $address = trim($input['address'] ?? '');

        if ($fullName === '') $errors['full_name'] = 'Họ tên không được để trống.';
        if ($email === '') {
            $errors['email'] = 'Email không được để trống.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không đúng định dạng.';
        }
        if (!in_array($gender, ['male', 'female', 'other'])) {
            $errors['gender'] = 'Giới tính không hợp lệ.';
        }

        return [
            'errors' => $errors,
            'values' => ['full_name' => $fullName, 'email' => $email, 'phone' => $phone, 'gender' => $gender, 'address' => $address]
        ];
    }

    public function createPatient(array $input): array
    {
        $validation = $this->validatePatientData($input);
        if (!empty($validation['errors'])) {
            return ['success' => false, 'errors' => $validation['errors']];
        }

        try {
            $this->repo->create($validation['values']);
            return ['success' => true, 'errors' => []];
        } catch (DuplicateRecordException $e) {
            return ['success' => false, 'errors' => ['email' => $e->getMessage()]];
        }
    }

    public function getPatientById(int $id): ?array
    {
        return $this->repo->findById($id);
    }

    public function updatePatient(int $id, array $input): array
    {
        if (!$this->repo->findById($id)) {
            return ['success' => false, 'errors' => ['general' => 'Bệnh nhân không tồn tại.']];
        }
        
        $validation = $this->validatePatientData($input);
        if (!empty($validation['errors'])) {
            return ['success' => false, 'errors' => $validation['errors']];
        }

        try {
            $this->repo->update($id, $validation['values']);
            return ['success' => true, 'errors' => []];
        } catch (DuplicateRecordException $e) {
            return ['success' => false, 'errors' => ['email' => 'Email này đã bị trùng với bệnh nhân khác.']];
        }
    }

    public function deletePatient(int $id): array
    {
        if ($id <= 0) return ['success' => false, 'errors' => ['general' => 'ID không hợp lệ.']];
        $this->repo->delete($id);
        return ['success' => true, 'errors' => []];
    }
}