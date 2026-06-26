<?php
// app/Controllers/HomeController.php
class HomeController
{
    public function index()
    {
        // 22110068 - Trỏ tới file app/Views/home/index.php
        render('home/index', ['title' => 'Phòng Khám - Đặt lịch hẹn']);
    }
}