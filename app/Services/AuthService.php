<?php
// app/Services/AuthService.php

require_once __DIR__ . '/../Repositories/UserRepository.php';

class AuthService
{
    private UserRepository $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function attemptLogin(string $email, string $password): array
    {
        $email = trim($email);
        if (empty($email) || empty($password)) {
            return ['success' => false, 'error' => 'Vui lòng nhập đầy đủ email và mật khẩu.'];
        }

        $user = $this->userRepo->findActiveByEmail($email);

        // password_verify tự động so sánh chuỗi nhập vào với hash $2y$10... trong DB
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'error' => 'Email hoặc mật khẩu không chính xác.'];
        }

        // T11: Đăng nhập thành công -> Phải tạo Session ID mới để chống Session Fixation
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['last_activity'] = time(); // Phục vụ Timeout sau này

        return ['success' => true];
    }

    public function logout(): void
    {
        // T12: Logout sạch sẽ (xóa biến, xóa cookie, hủy session)
        $_SESSION = [];
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        
        session_destroy();
    }
}