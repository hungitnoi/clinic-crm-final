<?php
// app/Controllers/HealthController.php

require_once __DIR__ . '/../Core/Database.php';

class HealthController
{
    public function index(): void
    {
        header('Content-Type: application/json');
        $status = [
            'app' => 'ok',
            'database' => 'disconnected',
            'timestamp' => date('Y-m-d H:i:s')
        ];

        try {
            $config = require __DIR__ . '/../../config/database.php';
            $db = Database::connect($config);
            $stmt = $db->query("SELECT 1");
            if ($stmt) {
                $status['database'] = 'connected';
            }
        } catch (Exception $e) {
            // Không làm gì cả, giữ nguyên disconnected
        }

        echo json_encode($status);
        exit; // Bắt buộc exit để không bị dính HTML của layout
    }
}