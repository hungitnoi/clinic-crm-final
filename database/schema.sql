-- database/schema.sql

CREATE DATABASE IF NOT EXISTS clinic_crm
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
USE clinic_crm;

-- Bảng 1: users (Quản lý tài khoản đăng nhập)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','staff') NOT NULL DEFAULT 'staff',
  status ENUM('active','inactive') NOT NULL DEFAULT 'active',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng 2: patients (Module A - Quản lý bệnh nhân)
CREATE TABLE patients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  gender ENUM('male','female','other') NOT NULL DEFAULT 'other',
  address TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL,
  UNIQUE KEY unique_patient_email (email),
  INDEX idx_patients_created_at (created_at)
);

-- Bảng 3: appointments (Module B - Quản lý lịch hẹn)
CREATE TABLE appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_code VARCHAR(50) NOT NULL,
  patient_name VARCHAR(100) NOT NULL,
  patient_phone VARCHAR(20) NOT NULL,
  appointment_date DATETIME NOT NULL,
  status ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL,
  UNIQUE KEY unique_appointment_code (appointment_code),
  INDEX idx_appointments_created_at (created_at),
  INDEX idx_appointments_status_date (status, appointment_date)
);