<?php
// app/Repositories/PatientRepository.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Core/DuplicateRecordException.php';

class PatientRepository
{
    private PDO $db;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        $this->db = Database::connect($config);
    }

    // Đếm tổng số dòng (dùng cho phân trang)
    public function countAll(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(*) AS total FROM patients";
        $params = [];
        if ($keyword !== '') {
            $sql .= " WHERE full_name LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    // Lấy dữ liệu có phân trang và sắp xếp an toàn
    public function getPaginated(string $keyword, int $limit, int $offset, string $sortCol, string $sortDir): array
    {
        $sql = "SELECT * FROM patients";
        $params = [];
        if ($keyword !== '') {
            $sql .= " WHERE full_name LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }
        
        $sql .= " ORDER BY {$sortCol} {$sortDir} LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Thêm bệnh nhân mới (Bắt lỗi trùng Email)
    public function create(array $data): bool
    {
        $sql = "INSERT INTO patients (full_name, email, phone, gender, address) 
                VALUES (:full_name, :email, :phone, :gender, :address)";
        $stmt = $this->db->prepare($sql);
        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && (int)$e->errorInfo[1] === 1062) {
                throw new DuplicateRecordException('Email này đã tồn tại trong hệ thống.');
            }
            throw $e;
        }
    }

    // Lấy thông tin 1 bệnh nhân để Sửa
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM patients WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $patient = $stmt->fetch();
        return $patient ?: null;
    }

    // Cập nhật thông tin
    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = "UPDATE patients SET full_name=:full_name, email=:email, phone=:phone, 
                gender=:gender, address=:address, updated_at=NOW() 
                WHERE id=:id";
        return $this->db->prepare($sql)->execute($data);
    }

    // Xóa bệnh nhân
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM patients WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}