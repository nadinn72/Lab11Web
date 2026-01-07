<?php
// Instance Database
$db = new Database();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    // Di sini Anda bisa menambahkan logika untuk menyimpan settings
    echo "<div class='alert alert-success'>
            <i class='fas fa-check-circle'></i> Pengaturan berhasil disimpan!
          </div>";
}
?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-cog"></i> Pengaturan Sistem</h3>
    </div>
    
    <div style="padding: 20px;">
        <form method="POST" action="">
            <div class="settings-tabs" style="margin-bottom: 30px;">
                <div style="display: flex; border-bottom: 2px solid #edf2f7; margin-bottom: 20px;">
                    <button type="button" class="tab-button active" onclick="showTab('general')" style="padding: 10px 20px; background: none; border: none; border-bottom: 2px solid #667eea; color: #667eea; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-sliders-h"></i> General
                    </button>
                    <button type="button" class="tab-button" onclick="showTab('database')" style="padding: 10px 20px; background: none; border: none; color: #718096; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-database"></i> Database
                    </button>
                    <button type="button" class="tab-button" onclick="showTab('security')" style="padding: 10px 20px; background: none; border: none; color: #718096; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-shield-alt"></i> Security
                    </button>
                    <button type="button" class="tab-button" onclick="showTab('appearance')" style="padding: 10px 20px; background: none; border: none; color: #718096; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-palette"></i> Appearance
                    </button>
                </div>
                
                <!-- General Settings -->
                <div id="general-tab" class="tab-content">
                    <div class="form-group">
                        <label class="form-label">Nama Aplikasi</label>
                        <input type="text" class="form-control" name="app_name" value="Sistem Modular PHP OOP" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email Administrator</label>
                        <input type="email" class="form-control" name="admin_email" value="admin@example.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">URL Website</label>
                        <input type="url" class="form-control" name="site_url" value="http://localhost/lab11_php_oop/" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Timezone</label>
                        <select class="form-control" name="timezone">
                            <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                            <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                            <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Database Settings -->
                <div id="database-tab" class="tab-content" style="display