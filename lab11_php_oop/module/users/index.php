<?php
// Instance Database
$db = new Database();

// Query data users
$users = $db->getAll('users', null, 'created_at DESC');

if (!isAdmin()) {
    echo '<div class="alert alert-danger">
        <i class="fas fa-ban"></i> Akses ditolak! Hanya admin yang dapat mengakses halaman ini.
    </div>';
    include 'template/footer.php';
    exit;
}

?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-users"></i> Manajemen Users</h3>
        <div class="card-actions">
            <a href="/lab11_php_oop/users/tambah" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Tambah User
            </a>
        </div>
    </div>
    
    <?php if(!empty($users)): ?>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Email</th>
                    <th width="15%">Tanggal Daftar</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td>#<?php echo $user['id']; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                <?php echo strtoupper(substr($user['nama'], 0, 1)); ?>
                            </div>
                            <div>
                                <strong><?php echo htmlspecialchars($user['nama']); ?></strong>
                                <?php if($user['id'] == 1): ?>
                                    <br><small style="color: #48bb78;">Super Admin</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($user['created_at'])); ?>
                        <br>
                        <small style="color: #718096;">
                            <?php echo date('H:i', strtotime($user['created_at'])); ?>
                        </small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/lab11_php_oop/users/edit/<?php echo $user['id']; ?>" 
                               class="btn btn-sm btn-info" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($user['id'] != 1): ?>
                            <a href="/lab11_php_oop/users/hapus/<?php echo $user['id']; ?>" 
                               class="btn btn-sm btn-danger" 
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?php else: ?>
    <div style="text-align: center; padding: 50px;">
        <i class="fas fa-users" style="font-size: 4rem; color: #e2e8f0; margin-bottom: 20px;"></i>
        <h3 style="color: #718096; margin-bottom: 15px;">Belum ada user terdaftar</h3>
        <p style="color: #a0aec0; margin-bottom: 25px;">Tambahkan user pertama untuk mulai mengelola</p>
        <a href="/lab11_php_oop/users/tambah" class="btn btn-primary btn-lg">
            <i class="fas fa-user-plus"></i> Tambah User Pertama
        </a>
    </div>
    <?php endif; ?>
</div>