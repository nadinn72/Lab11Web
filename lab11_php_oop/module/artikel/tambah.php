<?php
// Instance objek
$db = new Database();
$form = new Form("", "Simpan Artikel");

// Logika penyimpanan data jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = [
        'judul' => $_POST['judul'], 
        'konten' => $_POST['konten'], 
        'penulis' => $_POST['penulis'],
        'kategori' => $_POST['kategori'],
        'status' => $_POST['status'],
        'created_at' => date('Y-m-d H:i:s')
    ];

    // Simpan ke tabel 'artikel'
    $simpan = $db->insert('artikel', $data);

    if ($simpan) {
        echo "<div class='alert alert-success'>Artikel berhasil disimpan!</div>";
        // Redirect setelah 2 detik
        echo "<script>
                setTimeout(function() {
                    window.location.href = '/lab11_php_oop/artikel/index';
                }, 2000);
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan artikel.</div>";
    }
}
?>

<div class="form-container">
    <h3>Tambah Artikel Baru</h3>
    
    <?php
    // Menampilkan Form
    // 1. Input Text untuk Judul
    $form->addField("judul", "Judul Artikel");
    
    // 2. Input Text untuk Penulis
    $form->addField("penulis", "Penulis");
    
    // 3. Input Select untuk Kategori
    $form->addField("kategori", "Kategori", "select", [
        'teknologi' => 'Teknologi',
        'pendidikan' => 'Pendidikan',
        'kesehatan' => 'Kesehatan',
        'bisnis' => 'Bisnis',
        'hiburan' => 'Hiburan'
    ]);
    
    // 4. Input Radio untuk Status
    $form->addField("status", "Status", "radio", [
        'draft' => 'Draft',
        'published' => 'Published'
    ]);
    
    // 5. Input Textarea untuk Konten
    $form->addField("konten", "Konten Artikel", "textarea");
    
    // Tambahkan input hidden untuk submit
    echo '<input type="hidden" name="submit" value="1">';
    
    // Tampilkan Form
    $form->displayForm();
    ?>
</div>