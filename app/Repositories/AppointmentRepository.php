<?php
// app/Repositories/AppointmentRepository.php

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Core/DuplicateRecordException.php';

class AppointmentRepository
{
    private PDO $db;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        $this->db = Database::connect($config);
    }

    public function countAll(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(*) AS total FROM appointments";
        $params = [];
        if ($keyword !== '') {
            $sql .= " WHERE appointment_code LIKE :kw1 OR patient_name LIKE :kw2 OR patient_phone LIKE :kw3";
            $params['kw1'] = '%' . $keyword . '%';
            $params['kw2'] = '%' . $keyword . '%';
            $params['kw3'] = '%' . $keyword . '%';
        }   
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public function getPaginated(string $keyword, int $limit, int $offset, string $sortCol, string $sortDir): array
    {
        $sql = "SELECT * FROM appointments";
        $params = [];
        if ($keyword !== '') {
            $sql .= " WHERE appointment_code LIKE :kw1 OR patient_name LIKE :kw2 OR patient_phone LIKE :kw3";
            $params['kw1'] = '%' . $keyword . '%';
            $params['kw2'] = '%' . $keyword . '%';
            $params['kw3'] = '%' . $keyword . '%';
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

    public function create(array $data): bool
    {
        $sql = "INSERT INTO appointments (appointment_code, patient_name, patient_phone, appointment_date, status, notes) 
                VALUES (:appointment_code, :patient_name, :patient_phone, :appointment_date, :status, :notes)";
        $stmt = $this->db->prepare($sql);
        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && (int)$e->errorInfo[1] === 1062) {
                throw new DuplicateRecordException('Mã lịch hẹn này đã tồn tại.');
            }
            throw $e;
        }
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM appointments WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $appt = $stmt->fetch();
        return $appt ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = "UPDATE appointments SET appointment_code=:appointment_code, patient_name=:patient_name, 
                patient_phone=:patient_phone, appointment_date=:appointment_date, status=:status, notes=:notes, updated_at=NOW() 
                WHERE id=:id";
        try {
            return $this->db->prepare($sql)->execute($data);
        } catch (PDOException $e) {
            if (isset($e->errorInfo[1]) && (int)$e->errorInfo[1] === 1062) {
                throw new DuplicateRecordException('Mã lịch hẹn này đã tồn tại.');
            }
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM appointments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}