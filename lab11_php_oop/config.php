<?php
// config.php - Versi sederhana

$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '', // Sesuaikan dengan password MySQL Anda
    'db_name' => 'latihan_oop' 
];

// Mulai session jika belum dimulai
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek jika user belum login, set session kosong
if(!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        'id' => null,
        'nama' => 'Guest',
        'email' => '',
        'role' => 'guest'
    ];
    $_SESSION['user_logged_in'] = false;
}

// Helper function untuk cek role user - CEK APAKAH FUNGSI SUDAH ADA
if (!function_exists('isAdmin')) {
    function isAdmin() {
        // PERHATIKAN: Anda pakai $_SESSION['user'] bukan $_SESSION['users']
        // Sesuaikan dengan struktur session Anda
        return isset($_SESSION['users']['role']) && $_SESSION['users']['role'] == 'admin';
    }
}

if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
    }
}
?>