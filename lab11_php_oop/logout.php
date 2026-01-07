<?php
// logout.php
session_start();

// Include helper untuk base_url
require_once 'helper.php';

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['user']);

// Jika ada konfirmasi logout
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Simpan nama user untuk pesan
    $user_name = $_SESSION['user']['nama'] ?? 'User';
    
    // Hapus semua data session
    session_unset();
    session_destroy();
    
    // Redirect ke halaman login dengan pesan sukses
    header('Location: ' . base_url() . 'login.php?message=logout_success&user=' . urlencode($user_name));
    exit;
}

// Jika user tidak login, redirect ke login
if (!$is_logged_in) {
    header('Location: ' . base_url() . 'login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Sistem Modular PHP OOP</title>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('style.css'); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .logout-container {
            width: 100%;
            max-width: 500px;
        }
        
        .logout-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            padding: 40px;
            text-align: center;
            animation: fadeIn 0.6s ease;
            position: relative;
            overflow: hidden;
        }
        
        .logout-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #f56565 0%, #e53e3e 100%);
        }
        
        .logout-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2.5rem;
            animation: pulse 2s infinite;
            box-shadow: 0 10px 20px rgba(245, 101, 101, 0.3);
        }
        
        .logout-title {
            color: #2d3748;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .logout-subtitle {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        
        .logout-user-info {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
            text-align: left;
        }
        
        .logout-username {
            font-weight: 600;
            color: #2d3748;
            font-size: 1.2rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logout-email {
            color: #718096;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logout-message {
            color: #4a5568;
            font-size: 0.95rem;
            margin-bottom: 35px;
            line-height: 1.6;
            padding: 0 10px;
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            min-width: 160px;
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }
        
        .btn-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(245, 101, 101, 0.4);
        }
        
        .btn-cancel {
            background: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-cancel:hover {
            background: #cbd5e0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(203, 213, 224, 0.4);
        }
        
        .back-to-home {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #718096;
        }
        
        .back-to-home a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .back-to-home a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        /* Confirmation Modal */
        .confirmation-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
            padding: 20px;
        }
        
        .confirmation-modal.show {
            display: flex;
        }
        
        .confirmation-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: slideUp 0.4s ease;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        
        .confirmation-content:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #f56565 0%, #e53e3e 100%);
        }
        
        .confirmation-icon {
            font-size: 3rem;
            color: #f56565;
            margin-bottom: 20px;
        }
        
        .confirmation-title {
            color: #2d3748;
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .confirmation-message {
            color: #718096;
            margin-bottom: 30px;
            line-height: 1.5;
            font-size: 0.95rem;
        }
        
        .confirmation-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .btn-confirm {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .btn-confirm:hover {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            transform: translateY(-2px);
        }
        
        .btn-cancel-confirm {
            background: #e2e8f0;
            color: #4a5568;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-cancel-confirm:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 10px 20px rgba(245, 101, 101, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 30px rgba(245, 101, 101, 0.4);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 10px 20px rgba(245, 101, 101, 0.3);
            }
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .logout-card {
                padding: 30px 20px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                min-width: auto;
            }
            
            .confirmation-buttons {
                flex-direction: column;
            }
            
            .logout-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }
            
            .logout-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-card">
            <div class="logout-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            
            <h1 class="logout-title">Konfirmasi Logout</h1>
            
            <p class="logout-subtitle">
                Apakah Anda yakin ingin keluar dari sistem?
            </p>
            
            <div class="logout-user-info">
                <div class="logout-username">
                    <i class="fas fa-user"></i>
                    <?php echo htmlspecialchars($_SESSION['user']['nama'] ?? 'User'); ?>
                </div>
                <div class="logout-email">
                    <i class="fas fa-envelope"></i>
                    <?php echo htmlspecialchars($_SESSION['user']['email'] ?? 'No email'); ?>
                </div>
            </div>
            
            <p class="logout-message">
                Setelah logout, Anda perlu login kembali untuk mengakses sistem. Pastikan Anda telah menyimpan semua pekerjaan Anda.
            </p>
            
            <div class="button-group">
                <button onclick="showConfirmation()" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Ya, Logout Sekarang
                </button>
                <a href="<?php echo base_url(); ?>" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Batalkan
                </a>
            </div>
            
            <div class="back-to-home">
                <a href="<?php echo base_url(); ?>">
                    <i class="fas fa-home"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
    
    <!-- Confirmation Modal -->
    <div class="confirmation-modal" id="confirmationModal">
        <div class="confirmation-content">
            <div class="confirmation-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <h2 class="confirmation-title">Yakin Ingin Logout?</h2>
            
            <p class="confirmation-message">
                Anda akan keluar dari akun <strong><?php echo htmlspecialchars($_SESSION['user']['nama'] ?? 'User'); ?></strong>. 
                Pastikan Anda telah menyimpan semua perubahan.
            </p>
            
            <div class="confirmation-buttons">
                <a href="<?php echo base_url() . 'logout.php?confirm=yes'; ?>" class="btn-confirm">
                    Ya, Logout
                </a>
                <button onclick="hideConfirmation()" class="btn-cancel-confirm">
                    Batalkan
                </button>
            </div>
        </div>
    </div>
    
    <script>
        // Show confirmation modal
        function showConfirmation() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        
        // Hide confirmation modal
        function hideConfirmation() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmation();
            }
        });
        
        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideConfirmation();
            }
        });
        
        // Auto focus on cancel button when modal opens
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmationModal');
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class' && modal.classList.contains('show')) {
                        document.querySelector('.btn-cancel-confirm').focus();
                    }
                });
            });
            
            observer.observe(modal, { attributes: true });
        });
    </script>
</body>
</html>