<?php

$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '', // Sesuaikan dengan password MySQL Anda
    'db_name' => 'latihan_oop'
];

if(session_status() === PHP_SESSION_NONE) {
    session_start();
    
    if(!isset($_SESSION['user'])) {
        $_SESSION['user'] = [
            'id' => 1,
            'nama' => 'Administrator',
            'email' => 'admin@example.com',
            'role' => 'superadmin'
        ];
        $_SESSION['user_logged_in'] = true;
    }
}
?>