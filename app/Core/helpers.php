<?php
// app/Core/helpers.php

// 1. Khởi tạo Session an toàn (chạy trước khi output bất kỳ thứ gì)
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

// 2. Escape HTML chống XSS
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// 3. Chuyển hướng an toàn (PRG Pattern)
function redirect(string $path): void {
    header("Location: {$path}");
    exit;
}

// 4. Load View + Layout
function render(string $view, array $data = [], string $layout = 'layouts/main'): void {
    extract($data);
    ob_start();
    require __DIR__ . '/../Views/' . $view . '.php';
    $content = ob_get_clean();
    require __DIR__ . '/../Views/' . $layout . '.php';
}

// 5. Load một đoạn HTML nhỏ (Partial)
function partial(string $view, array $data = []): void {
    extract($data);
    require __DIR__ . '/../Views/' . $view . '.php';
}

// 6. Quản lý thông báo 1 lần (Flash message)
function flash(string $key, string $message): void {
    $_SESSION['flash'][$key] = $message;
}

function get_flash(string $key): ?string {
    if (empty($_SESSION['flash'][$key])) return null;
    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $message;
}

// 7. Giữ lại dữ liệu cũ khi nhập form sai
function old(string $key, string $default = ''): string {
    return $_SESSION['old'][$key] ?? $default;
}
// Bắt buộc đăng nhập
function require_login(): void {
    if (!isset($_SESSION['user_id'])) {
        flash('error', 'Vui lòng đăng nhập để truy cập.');
        redirect('/login');
    }
}