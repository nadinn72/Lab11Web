<?php
// Instance Database
$db = new Database();

// Hitung statistik
$total_artikel = $db->count('artikel');
$total_users = $db->count('users');
$artikel_published = $db->count('artikel', "status = 'published'");
$artikel_draft = $db->count('artikel', "status = 'draft'");

// Artikel terbaru
$artikel_terbaru = $db->getAll('artikel', null, 'created_at DESC', 5);

// Users terbaru
$users_terbaru = $db->getAll('users', null, 'created_at DESC', 5);
?>

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon articles">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h3>Total Artikel</h3>
            <div class="count"><?php echo $total_artikel; ?></div>
            <div class="trend up">
                <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon users">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>Total Users</h3>
            <div class="count"><?php echo $total_users; ?></div>
            <div class="trend up">
                <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon views">
            <i class="fas fa-eye"></i>
        </div>
        <div class="stat-info">
            <h3>Published</h3>
            <div class="count"><?php echo $artikel_published; ?></div>
            <div class="trend up">
                <i class="fas fa-check-circle"></i> <?php echo round(($artikel_published/$total_artikel)*100, 0); ?>% dari total
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon categories">
            <i class="fas fa-tags"></i>
        </div>
        <div class="stat-info">
            <h3>Draft</h3>
            <div class="count"><?php echo $artikel_draft; ?></div>
            <div class="trend down">
                <i class="fas fa-clock"></i> <?php echo round(($artikel_draft/$total_artikel)*100, 0); ?>% dari total
            </div>
        </div>
    </div>
</div>

<div class="content-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 30px; margin-top: 30px;">
    
    <!-- Artikel Terbaru -->
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-newspaper"></i> Artikel Terbaru</h3>
            <div class="card-actions">
                <a href="/lab11_php_oop/artikel/tambah" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Baru
                </a>
            </div>
        </div>
        
        <?php if(!empty($artikel_terbaru)): ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($artikel_terbaru as $artikel): ?>
                    <tr>
                        <td>
                            <a href="/lab11_php_oop/artikel/detail/<?php echo $artikel['id']; ?>" style="color: #4299e1; text-decoration: none;">
                                <?php echo htmlspecialchars(substr($artikel['judul'], 0, 40)); ?>
                                <?php echo strlen($artikel['judul']) > 40 ? '...' : ''; ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($artikel['penulis']); ?></td>
                        <td>
                            <span class="status-badge <?php echo $artikel['status'] == 'published' ? 'status-published' : 'status-draft'; ?>">
                                <?php echo $artikel['status'] == 'published' ? 'Published' : 'Draft'; ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($artikel['created_at'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-newspaper" style="font-size: 3rem; color: #e2e8f0; margin-bottom: 15px;"></i>
            <p style="color: #718096;">Belum ada artikel. <a href="/lab11_php_oop/artikel/tambah">Mulai buat artikel pertama</a></p>
        </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="/lab11_php_oop/artikel/index" class="btn btn-sm btn-primary">
                <i class="fas fa-list"></i> Lihat Semua Artikel
            </a>
        </div>
    </div>
    
    <!-- Users Terbaru -->
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-users"></i> Users Terbaru</h3>
            <div class="card-actions">
                <a href="/lab11_php_oop/users/tambah" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah User
                </a>
            </div>
        </div>
        
        <?php if(!empty($users_terbaru)): ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users_terbaru as $user): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center;">
                                    <?php echo strtoupper(substr($user['nama'], 0, 1)); ?>
                                </div>
                                <?php echo htmlspecialchars($user['nama']); ?>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-users" style="font-size: 3rem; color: #e2e8f0; margin-bottom: 15px;"></i>
            <p style="color: #718096;">Belum ada user terdaftar.</p>
        </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="/lab11_php_oop/users" class="btn btn-sm btn-primary">
                <i class="fas fa-list"></i> Lihat Semua Users
            </a>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
        </div>
        <div style="padding: 20px;">
            <div class="quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="/lab11_php_oop/artikel/tambah" class="btn btn-block btn-primary" style="justify-content: center;">
                    <i class="fas fa-plus"></i> Buat Artikel
                </a>
                <a href="/lab11_php_oop/users/tambah" class="btn btn-block btn-success" style="justify-content: center;">
                    <i class="fas fa-user-plus"></i> Tambah User
                </a>
                <a href="/lab11_php_oop/settings" class="btn btn-block btn-info" style="justify-content: center;">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
                <a href="/lab11_php_oop/artikel/index" class="btn btn-block btn-warning" style="justify-content: center;">
                    <i class="fas fa-chart-bar"></i> Statistik
                </a>
            </div>
        </div>
    </div>
    
    <!-- System Info -->
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-info-circle"></i> System Information</h3>
        </div>
        <div style="padding: 20px;">
            <div class="system-info">
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #edf2f7;">
                    <span>PHP Version</span>
                    <strong><?php echo phpversion(); ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #edf2f7;">
                    <span>Server Software</span>
                    <strong><?php echo $_SERVER['SERVER_SOFTWARE']; ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #edf2f7;">
                    <span>Database Driver</span>
                    <strong>MySQLi</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #edf2f7;">
                    <span>Session Status</span>
                    <strong style="color: #48bb78;">
                        <?php echo session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive'; ?>
                    </strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Memory Usage</span>
                    <strong><?php echo round(memory_get_usage() / 1024 / 1024, 2); ?> MB</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="content-card" style="margin-top: 30px;">
    <div class="card-header">
        <h3><i class="fas fa-history"></i> Recent Activity</h3>
    </div>
    <div style="padding: 20px;">
        <div class="activity-timeline">
            <div style="display: flex; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #edf2f7;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; margin-right: 15px;">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <strong>Administrator</strong> logged in
                    <div style="color: #718096; font-size: 0.9rem;">Just now</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #edf2f7;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); display: flex; align-items: center; justify-content: center; color: white; margin-right: 15px;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <strong>Artikel baru</strong> "Pengenalan PHP OOP" telah dibuat
                    <div style="color: #718096; font-size: 0.9rem;">2 hours ago</div>
                </div>
            </div>
            <div style="display: flex; align-items: center;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); display: flex; align-items: center; justify-content: center; color: white; margin-right: 15px;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <strong>User baru</strong> "John Doe" telah terdaftar
                    <div style="color: #718096; font-size: 0.9rem;">Yesterday</div>
                </div>
            </div>
        </div>
    </div>
</div>