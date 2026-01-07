<?php
// Data log aktivitas contoh
$logs = [
    [
        'id' => 1,
        'user' => 'Administrator',
        'action' => 'Login ke sistem',
        'ip' => '127.0.0.1',
        'timestamp' => date('Y-m-d H:i:s'),
        'browser' => 'Chrome/120.0'
    ],
    [
        'id' => 2,
        'user' => 'Administrator',
        'action' => 'Menambah artikel baru: "Pengenalan PHP OOP"',
        'ip' => '127.0.0.1',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-2 hours')),
        'browser' => 'Chrome/120.0'
    ],
    [
        'id' => 3,
        'user' => 'Budi Santoso',
        'action' => 'Login ke sistem',
        'ip' => '192.168.1.100',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'browser' => 'Firefox/119.0'
    ],
    [
        'id' => 4,
        'user' => 'Administrator',
        'action' => 'Mengupdate pengaturan sistem',
        'ip' => '127.0.0.1',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-2 days')),
        'browser' => 'Chrome/119.0'
    ],
    [
        'id' => 5,
        'user' => 'Sari Dewi',
        'action' => 'Mendaftar sebagai user baru',
        'ip' => '192.168.1.101',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-3 days')),
        'browser' => 'Safari/17.0'
    ],
];
?>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-history"></i> Activity Log</h3>
        <div class="card-actions">
            <button class="btn btn-danger" onclick="clearLogs()">
                <i class="fas fa-trash"></i> Clear Logs
            </button>
            <button class="btn btn-info" onclick="exportLogs()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">User</th>
                    <th width="30%">Action</th>
                    <th width="15%">IP Address</th>
                    <th width="15%">Timestamp</th>
                    <th width="15%">Browser</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log): ?>
                <tr>
                    <td>#<?php echo $log['id']; ?></td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; 
                                 background: <?php echo $log['user'] == 'Administrator' ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#48bb78'; ?>; 
                                 color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                <?php echo strtoupper(substr($log['user'], 0, 1)); ?>
                            </div>
                            <strong><?php echo $log['user']; ?></strong>
                        </div>
                    </td>
                    <td>
                        <?php echo $log['action']; ?>
                        <br>
                        <small style="color: #718096;">
                            <i class="fas fa-info-circle"></i> <?php echo $log['user'] == 'Administrator' ? 'System Action' : 'User Action'; ?>
                        </small>
                    </td>
                    <td>
                        <code style="background: #edf2f7; padding: 2px 6px; border-radius: 4px;">
                            <?php echo $log['ip']; ?>
                        </code>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($log['timestamp'])); ?>
                        <br>
                        <small style="color: #718096;">
                            <?php echo date('H:i:s', strtotime($log['timestamp'])); ?>
                        </small>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: #4a5568;">
                            <?php echo $log['browser']; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; background: #f7fafc; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <strong>Total Logs:</strong> <?php echo count($logs); ?> aktivitas
            <span style="margin-left: 15px;">
                <?php 
                $today = array_filter($logs, function($l) { 
                    return date('Y-m-d', strtotime($l['timestamp'])) == date('Y-m-d'); 
                });
                $week = array_filter($logs, function($l) { 
                    return strtotime($l['timestamp']) > strtotime('-7 days'); 
                });
                ?>
                <span style="color: #48bb78;"><i class="fas fa-calendar-day"></i> <?php echo count($today); ?> hari ini</span>
                <span style="margin-left: 10px; color: #4299e1;"><i class="fas fa-calendar-week"></i> <?php echo count($week); ?> 7 hari terakhir</span>
            </span>
        </div>
        <div class="pagination">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
        </div>
    </div>
</div>

<script>
function clearLogs() {
    if(confirm('Yakin ingin menghapus semua log aktivitas?')) {
        alert('Logs akan dihapus (simulasi)');
        // Di sini Anda bisa menambahkan AJAX untuk menghapus logs
    }
}

function exportLogs() {
    alert('Export logs ke CSV (simulasi)');
}
</script>