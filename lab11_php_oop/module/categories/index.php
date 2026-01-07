<?php
// Instance Database
require_once __DIR__ . '/../../class/Database.php';

$db = new Database();

// Ambil data kategori dari database
$categories = $db->getAll('categories', null, 'id ASC');

// Jika tabel categories belum ada atau kosong, gunakan data contoh
if (empty($categories)) {
    $categories = [
        ['id' => 1, 'nama' => 'Teknologi', 'slug' => 'teknologi', 'jumlah' => 5, 'status' => 'active'],
        ['id' => 2, 'nama' => 'Pendidikan', 'slug' => 'pendidikan', 'jumlah' => 3, 'status' => 'active'],
        ['id' => 3, 'nama' => 'Kesehatan', 'slug' => 'kesehatan', 'jumlah' => 2, 'status' => 'active'],
        ['id' => 4, 'nama' => 'Bisnis', 'slug' => 'bisnis', 'jumlah' => 1, 'status' => 'active'],
        ['id' => 5, 'nama' => 'Hiburan', 'slug' => 'hiburan', 'jumlah' => 0, 'status' => 'inactive'],
    ];
}
?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-tags"></i> Manajemen Kategori</h3>
        <div class="card-actions">
            <button class="btn btn-primary" onclick="showAddCategory()">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="30%">Nama Kategori</th>
                    <th width="20%">Jumlah Artikel</th>
                    <th width="20%">Status</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $cat): ?>
                <tr>
                    <td>#<?php echo $cat['id']; ?></td>
                    <td>
                        <strong><?php echo htmlspecialchars($cat['nama']); ?></strong>
                        <br>
                        <small style="color: #718096;">Slug: <?php echo isset($cat['slug']) ? htmlspecialchars($cat['slug']) : strtolower(str_replace(' ', '-', $cat['nama'])); ?></small>
                    </td>
                    <td>
                        <span class="badge" style="background: #4299e1; color: white; padding: 3px 8px; border-radius: 12px;">
                            <?php echo isset($cat['jumlah']) ? $cat['jumlah'] : '0'; ?> artikel
                        </span>
                    </td>
                    <td>
                        <span class="status-badge <?php echo (isset($cat['status']) && $cat['status'] == 'active') ? 'status-published' : 'status-draft'; ?>">
                            <?php echo (isset($cat['status']) && $cat['status'] == 'active') ? 'Aktif' : 'Nonaktif'; ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-info" onclick="editCategory(<?php echo $cat['id']; ?>)">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="toggleCategory(<?php echo $cat['id']; ?>)">
                                <i class="fas fa-power-off"></i> Toggle
                            </button>
                            <?php if((isset($cat['jumlah']) && $cat['jumlah'] == 0) || !isset($cat['jumlah'])): ?>
                            <button class="btn btn-sm btn-danger" onclick="deleteCategory(<?php echo $cat['id']; ?>)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; background: #f7fafc; border-radius: 8px;">
        <strong>Total Kategori:</strong> <?php echo count($categories); ?> kategori
        <span style="margin-left: 15px;">
            <?php 
            $active = array_filter($categories, function($c) { 
                return (isset($c['status']) && $c['status'] == 'active'); 
            });
            $inactive = array_filter($categories, function($c) { 
                return (!isset($c['status']) || $c['status'] == 'inactive'); 
            });
            ?>
            <span class="status-published" style="padding: 2px 6px;"><?php echo count($active); ?> Aktif</span>
            <span class="status-draft" style="padding: 2px 6px; margin-left: 5px;"><?php echo count($inactive); ?> Nonaktif</span>
        </span>
    </div>
</div>

<script>
function showAddCategory() {
    alert('Fitur tambah kategori akan diimplementasikan');
}

function editCategory(id) {
    alert('Edit kategori ID: ' + id);
}

function toggleCategory(id) {
    alert('Toggle status kategori ID: ' + id);
}

function deleteCategory(id) {
    if(confirm('Yakin ingin menghapus kategori ini?')) {
        alert('Hapus kategori ID: ' + id);
    }
}
</script>