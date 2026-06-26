<?php
// app/Core/Database.php

class Database
{
    private static ?PDO $connection = null;

    public static function connect(array $config): PDO
    {
        if (self::$connection === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['database'],
                $config['charset']
            );

            try {
                self::$connection = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // Sửa tạm dòng này để xem lỗi thật sự là gì
                die("Lỗi kết nối CSDL: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}