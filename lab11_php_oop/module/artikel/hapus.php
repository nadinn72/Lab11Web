<?php
// Instance Database
$db = new Database();

// Ambil ID dari URL
$id = isset($segments[2]) ? $segments[2] : 0;

if ($id > 0) {
    // Hapus data
    $deleted = $db->delete('artikel', "id = $id");
    
    if ($deleted) {
        // Redirect dengan status sukses
        header("Location: /lab11_php_oop/artikel/index?status=deleted");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Gagal menghapus artikel: " . $db->getError() . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID tidak valid!</div>";
}

// Redirect kembali setelah 3 detik
echo "<script>
        setTimeout(function() {
            window.location.href = '/lab11_php_oop/artikel/index';
        }, 3000);
      </script>";
?>