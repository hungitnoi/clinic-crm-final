<?php
// app/Controllers/DashboardController.php

class DashboardController
{
    public function index(): void
    {
        // Bắt buộc đăng nhập mới được vào trang này
        if (!isset($_SESSION['user_id'])) {
            flash('error', 'Vui lòng đăng nhập để truy cập.');
            redirect('/login');
        }
        
        render('dashboard/index', ['title' => 'Tổng quan - Clinic CRM']);
    }
}