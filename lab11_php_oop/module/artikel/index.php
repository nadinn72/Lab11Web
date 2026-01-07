<?php
// module/artikel/index.php

// Jika diakses langsung, redirect ke routing yang benar
if (basename(dirname(__FILE__)) == 'artikel' && 
    (!isset($mod) || $mod != 'artikel')) {
    
    // Cek jika ini diakses langsung (bukan melalui routing)
    $current_url = $_SERVER['REQUEST_URI'];
    $base_path = dirname(dirname(dirname(__FILE__)));
    
    if (strpos($current_url, 'artikel') === false) {
        // Redirect ke routing yang benar
        $redirect_url = str_replace('/module/artikel/index.php', '/artikel', $_SERVER['PHP_SELF']);
        header('Location: ' . $redirect_url);
        exit;
    }
}

// Include Database class
require_once __DIR__ . '/../../class/Database.php';

// Instance Database
$db = new Database();

// Ambil data artikel
$result = $db->query("SELECT * FROM artikel");
$artikel = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artikel[] = $row;
    }
}
?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-newspaper"></i> Daftar Artikel</h3>
        <div class="card-actions">
            <a href="/lab11_php_oop/artikel/tambah" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Artikel
            </a>
        </div>
    </div>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Artikel berhasil dihapus!
        </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Artikel berhasil diperbarui!
        </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'created'): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Artikel berhasil dibuat!
        </div>
    <?php endif; ?>
    
    <?php if(!empty($artikel)): ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Judul</th>
                    <th width="20%">Penulis</th>
                    <th width="15%">Kategori</th>
                    <th width="10%">Status</th>
                    <th width="15%">Tanggal</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($artikel as $row): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td>
                        <strong><?php echo htmlspecialchars(substr($row['judul'], 0, 50)); ?></strong>
                        <?php echo strlen($row['judul']) > 50 ? '...' : ''; ?>
                        <?php if($row['status'] == 'draft'): ?>
                            <br><small style="color: #718096;">Draft - belum dipublikasi</small>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['penulis']); ?></td>
                    <td>
                        <span style="display: inline-block; padding: 3px 8px; background: #edf2f7; border-radius: 4px; color: #4a5568;">
                            <?php echo ucfirst($row['kategori']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge <?php echo $row['status'] == 'published' ? 'status-published' : 'status-draft'; ?>">
                            <?php echo $row['status'] == 'published' ? 'Published' : 'Draft'; ?>
                        </span>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($row['created_at'])); ?>
                        <br>
                        <small style="color: #718096;">
                            <?php echo date('H:i', strtotime($row['created_at'])); ?>
                        </small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/lab11_php_oop/artikel/ubah/<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-info" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/lab11_php_oop/artikel/hapus/<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger" 
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="/lab11_php_oop/artikel/detail/<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-primary" 
                               title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; background: #f7fafc; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <strong>Total Artikel:</strong> <?php echo count($artikel); ?> artikel
            <span style="margin-left: 15px;">
                <span class="status-published" style="padding: 2px 6px;"><?php 
                    $published = array_filter($artikel, function($a) { return $a['status'] == 'published'; });
                    echo count($published); 
                ?> Published</span>
                <span class="status-draft" style="padding: 2px 6px; margin-left: 5px;"><?php 
                    $draft = array_filter($artikel, function($a) { return $a['status'] == 'draft'; });
                    echo count($draft); 
                ?> Draft</span>
            </span>
        </div>
        <div class="pagination">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
        </div>
    </div>
    
    <?php else: ?>
    <div style="text-align: center; padding: 50px;">
        <i class="fas fa-newspaper" style="font-size: 4rem; color: #e2e8f0; margin-bottom: 20px;"></i>
        <h3 style="color: #718096; margin-bottom: 15px;">Belum ada artikel</h3>
        <p style="color: #a0aec0; margin-bottom: 25px;">Mulai dengan membuat artikel pertama Anda</p>
        <a href="/lab11_php_oop/artikel/tambah" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Buat Artikel Pertama
        </a>
    </div>
    <?php endif; ?>
</div>