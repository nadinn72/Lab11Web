<?php
/**
 * Helper functions
 */

function base_url($path = '') {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $base = dirname($script);
    
    // Clean up double slashes
    $base = rtrim($base, '/');
    $path = ltrim($path, '/');
    
    return $base . '/' . $path;
}

function current_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function is_active($mod, $page = '') {
    global $mod, $page;
    
    if(!empty($page)) {
        return ($GLOBALS['mod'] == $mod && $GLOBALS['page'] == $page) ? 'active' : '';
    }
    return ($GLOBALS['mod'] == $mod) ? 'active' : '';
}
?>