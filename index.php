<?php
// Load konfigurasi
include "config.php";

// Load helper
if(file_exists("helper.php")) {
    include "helper.php";
} else {
    // Fallback function jika helper.php tidak ada
    function base_url($path = '') {
        $script = $_SERVER['SCRIPT_NAME'];
        $base = dirname($script);
        $base = rtrim($base, '/');
        $path = ltrim($path, '/');
        return $base . '/' . $path;
    }
}

// Include class yang diperlukan
include "class/Database.php";
include "class/Form.php";

// PASTIKAN hanya panggil session_start() jika belum aktif
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ROUTING LOGIC
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';

// Memecah path menjadi array
$segments = explode('/', trim($path, '/'));

// Menentukan Module (default: home)
$mod = isset($segments[0]) ? $segments[0] : 'home';

// Menentukan Action/Page (default: index)
$page = isset($segments[1]) ? $segments[1] : 'index';

// Debug info (bisa dihapus setelah fix)
error_log("Routing: Module=$mod, Page=$page");

// Menentukan path file modul
$file = "module/{$mod}/{$page}.php";

// LOAD TEMPLATE & KONTEN
include "template/header.php";

// Cek apakah file modul ada
if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> 
            Modul tidak ditemukan: ' . $mod . '/' . $page . 
            '<br><small>File: ' . $file . ' tidak ditemukan</small>
        </div>';
}

include "template/footer.php";
?>