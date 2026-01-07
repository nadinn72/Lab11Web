<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Modular PHP OOP</title>
    
    <!-- Gunakan base_url() untuk path yang benar -->
    <link rel="stylesheet" href="<?php echo base_url('style.css'); ?>">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Inline Critical CSS sebagai fallback -->
    <style>
        /* CRITICAL CSS - Load First */
        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --secondary: #48bb78;
            --dark: #2d3748;
            --light: #f8fafc;
            --gray: #718096;
            --danger: #f56565;
            --warning: #ecc94b;
            --info: #4299e1;
        }
        
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        body { 
            font-family: 'Inter', 'Segoe UI', sans-serif; 
            background: var(--light); 
            color: #333; 
            line-height: 1.6; 
            min-height: 100vh;
        }
        
        .app-container { 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }
        
        .app-header { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); 
            color: white; 
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .main-layout { 
            display: flex; 
            flex: 1; 
        }
        
        .app-sidebar { 
            width: 280px; 
            background: var(--dark); 
            color: white; 
            padding: 25px 0;
            min-height: calc(100vh - 70px);
            position: sticky;
            top: 70px;
        }
        
        .app-content { 
            flex: 1; 
            padding: 30px; 
            background: var(--light); 
            min-height: calc(100vh - 70px);
        }
        
        .content-card { 
            background: white; 
            padding: 25px; 
            border-radius: 12px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
            margin-bottom: 25px; 
        }
        
        .alert { 
            padding: 15px 20px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            border-left: 4px solid; 
        }
        
        .alert-success { 
            background: #f0fff4; 
            border-color: var(--secondary); 
            color: #22543d; 
        }
        
        .alert-danger { 
            background: #fff5f5; 
            border-color: var(--danger); 
            color: #742a2a; 
        }
        
        .btn { 
            display: inline-block; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 6px; 
            font-weight: 600; 
            cursor: pointer; 
            text-decoration: none; 
            transition: all 0.3s ease;
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); 
            color: white; 
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: white; 
            border-radius: 8px;
            overflow: hidden;
        }
        
        th { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); 
            color: white; 
            padding: 12px 15px; 
            text-align: left; 
            font-weight: 600;
        }
        
        td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #e2e8f0; 
        }
        
        tr:hover {
            background: #f7fafc;
        }
        
        .status-badge { 
            display: inline-block; 
            padding: 4px 10px; 
            border-radius: 20px; 
            font-size: 0.85rem; 
            font-weight: 600; 
        }
        
        .status-published { 
            background: linear-gradient(135deg, var(--secondary) 0%, #38a169 100%); 
            color: white; 
        }
        
        .status-draft { 
            background: linear-gradient(135deg, #ecc94b 0%, #d69e2e 100%); 
            color: white; 
        }
        
        .status-admin { 
            background: linear-gradient(135deg, var(--danger) 0%, #c53030 100%); 
            color: white; 
        }
        
        .status-user { 
            background: linear-gradient(135deg, var(--info) 0%, #3182ce 100%); 
            color: white; 
        }
        
        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb li {
            margin-right: 8px;
            color: var(--gray);
        }
        
        .breadcrumb li:after {
            content: '/';
            margin-left: 8px;
        }
        
        .breadcrumb li:last-child:after {
            content: '';
        }
        
        .breadcrumb li a {
            color: var(--primary);
            text-decoration: none;
        }
        
        /* Profile Dropdown Styles */
        .profile-container {
            position: relative;
        }
        
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .profile-btn:hover {
            background: rgba(255,255,255,0.2);
        }
        
        .profile-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .admin-badge {
            background: var(--danger) !important;
        }
        
        .profile-info {
            text-align: left;
        }
        
        .profile-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .profile-role {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: white;
            min-width: 220px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }
        
        .profile-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }
        
        .dropdown-body {
            padding: 0;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background: #f7fafc;
            color: var(--primary);
        }
        
        .dropdown-item i {
            width: 20px;
            color: var(--gray);
        }
        
        .dropdown-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 5px 0;
        }
        
        .logout-btn {
            color: var(--danger);
        }
        
        .logout-btn:hover {
            background: #fff5f5;
        }
        
        .logout-btn i {
            color: var(--danger);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .app-header {
                padding: 15px 20px;
                flex-wrap: wrap;
            }
            
            .main-layout {
                flex-direction: column;
            }
            
            .app-sidebar {
                width: 100%;
                position: static;
                min-height: auto;
            }
            
            .app-content {
                padding: 20px;
            }
            
            .breadcrumb {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1 style="font-size: 1.5rem; margin: 0;"><i class="fas fa-code"></i> Sistem Modular PHP OOP</h1>
            <div class="profile-container">
                <div class="profile-btn" onclick="toggleProfileDropdown()">
                    <div class="profile-avatar <?php echo (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') ? 'admin-badge' : ''; ?>">
                        <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <i class="fas fa-crown"></i>
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">
                            <?php echo isset($_SESSION['user']['nama']) ? htmlspecialchars($_SESSION['user']['nama']) : 'Guest User'; ?>
                            <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
                                <span class="status-admin" style="margin-left: 5px; padding: 2px 6px; font-size: 0.7rem;">ADMIN</span>
                            <?php endif; ?>
                        </div>
                        <div class="profile-role"><?php echo isset($_SESSION['user']['role']) ? htmlspecialchars(ucfirst($_SESSION['user']['role'])) : 'Please Login'; ?></div>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </div>
                
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="dropdown-header">
                        <div style="font-weight: 600; margin-bottom: 3px;">
                            <?php echo isset($_SESSION['user']['nama']) ? htmlspecialchars($_SESSION['user']['nama']) : 'Guest User'; ?>
                            <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
                                <span class="status-admin" style="margin-left: 5px; padding: 2px 6px; font-size: 0.7rem;">ADMIN</span>
                            <?php endif; ?>
                        </div>
                        <div style="font-size: 0.85rem; opacity: 0.9;"><?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : 'Not logged in'; ?></div>
                    </div>
                    
                    <div class="dropdown-body">
                        <?php if(isset($_SESSION['user'])): ?>
                            <!-- Menu untuk user yang sudah login -->
                            <a href="<?php echo base_url(); ?>?mod=user&page=profile" class="dropdown-item">
                                <i class="fas fa-user-circle"></i>
                                <span>My Profile</span>
                            </a>
                            
                            <?php if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin'): ?>
                                <!-- Menu khusus admin -->
                                <a href="<?php echo base_url(); ?>?mod=users" class="dropdown-item">
                                    <i class="fas fa-users-cog"></i>
                                    <span>Manage Users</span>
                                </a>
                                
                                <a href="<?php echo base_url(); ?>?mod=settings" class="dropdown-item">
                                    <i class="fas fa-tools"></i>
                                    <span>System Settings</span>
                                </a>
                                
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                            
                            <a href="<?php echo base_url(); ?>?mod=user&page=settings" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a href="<?php echo base_url(); ?>logout.php" class="dropdown-item logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        <?php else: ?>
                            <!-- Menu untuk user yang belum login -->
                            <a href="<?php echo base_url(); ?>login.php" class="dropdown-item">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                            
                            <a href="<?php echo base_url(); ?>?mod=auth&page=register" class="dropdown-item">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
            <div class="main-layout">
                <?php 
                // Pastikan file sidebar.php ada sebelum di-include
                // Perhatikan: sidebar.php ada di folder template/
                if (file_exists('template/sidebar.php')) {
                    include 'template/sidebar.php';
                } else if (file_exists('sidebar.php')) {
                    include 'sidebar.php';
                } else {
                    echo '<div class="app-sidebar"><p>Sidebar not found</p></div>';
                }
                ?>
            
            <main class="app-content">
                <div class="content-card">
                    <?php
                    // Cek apakah variabel $module dan $page sudah didefinisikan
                    $module = isset($module) ? $module : 'home';
                    $page = isset($page) ? $page : 'index';
                    ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #edf2f7;">
                        <div>
                            <h1 style="color: var(--dark); font-size: 2rem; margin-bottom: 5px;">
                                <?php 
                                if($module == 'home') {
                                    echo 'Dashboard Sistem';
                                } else {
                                    echo ucfirst($module) . ' Management';
                                }
                                ?>
                            </h1>
                            <p style="color: var(--gray); font-size: 1.1rem;">Laboratorium 11 - Pemrograman Web Lanjutan</p>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
                                <li><?php echo htmlspecialchars(ucfirst($module)); ?></li>
                                <?php if($page != 'index'): ?>
                                <li><?php echo htmlspecialchars(ucfirst($page)); ?></li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>
                    
                    <script>
                        // Toggle profile dropdown
                        function toggleProfileDropdown() {
                            var dropdown = document.getElementById('profileDropdown');
                            dropdown.classList.toggle('show');
                        }
                        
                        // Close dropdown when clicking outside
                        document.addEventListener('click', function(event) {
                            var dropdown = document.getElementById('profileDropdown');
                            var profileBtn = document.querySelector('.profile-btn');
                            
                            if (!profileBtn.contains(event.target) && !dropdown.contains(event.target)) {
                                dropdown.classList.remove('show');
                            }
                        });
                    </script>