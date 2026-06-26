<?php
// public/index.php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../app/Core/helpers.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/login' => 'AuthController@login',
        '/dashboard' => 'DashboardController@index',
        '/patients'  => 'PatientController@index',
        '/patients/create' => 'PatientController@create',
        '/patients/edit' => 'PatientController@edit',
        '/public-patients/create' => 'PublicPatientController@create',
        '/appointments'  => 'AppointmentController@index',
        '/appointments/create' => 'AppointmentController@create',
        '/appointments/edit' => 'AppointmentController@edit',
        '/health' => 'HealthController@index', 

    ],
    'POST' => [
        '/login' => 'AuthController@handleLogin',
        '/logout' => 'AuthController@logout',
        '/patients/store' => 'PatientController@store',
        '/patients/update' => 'PatientController@update',
        '/patients/delete' => 'PatientController@delete',
        '/public-patients/store' => 'PublicPatientController@store',
        '/appointments/store' => 'AppointmentController@store',
        '/appointments/update' => 'AppointmentController@update',
        '/appointments/delete' => 'AppointmentController@delete', 
    ]
];

if (!isset($routes[$method][$path])) {
    $pathExists = false;
    foreach ($routes as $routeMethod => $routePaths) {
        if (isset($routePaths[$path])) $pathExists = true;
    }
    
    if ($pathExists) {
        http_response_code(405);
        render('errors/405', ['title' => '405 Method Not Allowed']); // Đã sửa
        exit;
    }
    
    http_response_code(404);
    render('errors/404', ['title' => '404 Not Found']); // Đã sửa
    exit;
}

[$class, $action] = explode('@', $routes[$method][$path]);
require_once __DIR__ . "/../app/Controllers/{$class}.php";

$controller = new $class();
$controller->$action();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['old'])) {
    unset($_SESSION['old']);
}