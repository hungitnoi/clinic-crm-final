<?php
// app/Controllers/AuthController.php

require_once __DIR__ . '/../Services/AuthService.php';

class AuthController
{
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login(): void
    {
        // Đã login thì không cho vào trang login nữa
        if (isset($_SESSION['user_id'])) {
            redirect('/dashboard');
        }
        render('auth/login', ['title' => 'Đăng nhập - Clinic CRM']);
    }

    public function handleLogin(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->authService->attemptLogin($email, $password);

        if (!$result['success']) {
            $_SESSION['old']['email'] = $email;
            flash('error', $result['error']);
            redirect('/login');
        }

        flash('success', 'Đăng nhập thành công!');
        redirect('/dashboard');
    }

    public function logout(): void
    {
        $this->authService->logout();
        redirect('/login');
    }
}