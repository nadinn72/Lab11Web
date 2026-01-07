<?php
// Instance objek
$db = new Database();
$form = new Form("", "Update Artikel");

// Ambil ID dari URL
$id = isset($segments[2]) ? $segments[2] : 0;

// Ambil data artikel yang akan diedit
$artikel = $db->get('artikel', "id = $id");

// Logika update data jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = [
        'judul' => $_POST['judul'], 
        'konten' => $_POST['konten'], 
        'penulis' => $_POST['penulis'],
        'kategori' => $_POST['kategori'],
        'status' => $_POST['status'],
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Update data artikel
    $update = $db->update('artikel', $data, "id = $id");

    if ($update) {
        echo "<div class='alert alert-success'>Artikel berhasil diperbarui!</div>";
        // Refresh data
        $artikel = $db->get('artikel', "id = $id");
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui artikel.</div>";
    }
}

// Jika artikel tidak ditemukan
if (!$artikel) {
    echo "<div class='alert alert-danger'>Artikel tidak ditemukan!</div>";
    include "template/footer.php";
    exit();
}
?>

<div class="form-container">
    <h3>Edit Artikel</h3>
    
    <?php
    // Menampilkan Form dengan data yang ada
    // 1. Input Text untuk Judul
    $form->addField("judul", "Judul Artikel", "text", [], $artikel['judul']);
    
    // 2. Input Text untuk Penulis
    $form->addField("penulis", "Penulis", "text", [], $artikel['penulis']);
    
    // 3. Input Select untuk Kategori
    $form->addField("kategori", "Kategori", "select", [
        'teknologi' => 'Teknologi',
        'pendidikan' => 'Pendidikan',
        'kesehatan' => 'Kesehatan',
        'bisnis' => 'Bisnis',
        'hiburan' => 'Hiburan'
    ], $artikel['kategori']);
    
    // 4. Input Radio untuk Status
    $form->addField("status", "Status", "radio", [
        'draft' => 'Draft',
        'published' => 'Published'
    ], $artikel['status']);
    
    // 5. Input Textarea untuk Konten
    $form->addField("konten", "Konten Artikel", "textarea", [], $artikel['konten']);
    
    // Tambahkan input hidden untuk submit
    echo '<input type="hidden" name="submit" value="1">';
    
    // Tampilkan Form
    $form->displayForm();
    ?>
</div>