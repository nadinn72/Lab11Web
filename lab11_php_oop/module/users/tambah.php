<?php
// Instance objek
$db = new Database();
$form = new Form("", "Simpan User", "POST");

// Logika penyimpanan data jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = [
        'nama' => $_POST['nama'], 
        'email' => $_POST['email'], 
        'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT), 
        'created_at' => date('Y-m-d H:i:s')
    ];

    // Simpan ke tabel 'users'
    $simpan = $db->insert('users', $data);

    if ($simpan) {
        echo "<div class='alert alert-success'>
                <i class='fas fa-check-circle'></i> User berhasil ditambahkan!
              </div>";
        // Redirect setelah 2 detik
        echo "<script>
                setTimeout(function() {
                    window.location.href = '/lab11_php_oop/users';
                }, 2000);
              </script>";
    } else {
        echo "<div class='alert alert-danger'>
                <i class='fas fa-exclamation-circle'></i> Gagal menambahkan user: " . $db->getError() . "
              </div>";
    }
}
?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-user-plus"></i> Tambah User Baru</h3>
        <div class="card-actions">
            <a href="/lab11_php_oop/users" class="btn btn-info">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="form-container" style="background: none; padding: 0; box-shadow: none;">
        <?php
        // Menampilkan Form
        // 1. Input Text Biasa
        $form->addField("nama", "Nama Lengkap");
        $form->addField("email", "Email", "email");
        
        // 2. Input Password
        $form->addField("pass", "Password", "password");
        
        // Tambahkan input hidden untuk submit
        echo '<input type="hidden" name="submit" value="1">';
        
        // Tampilkan Form
        $form->displayForm();
        ?>
    </div>
</div>