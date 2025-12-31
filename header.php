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
    </style>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1 style="font-size: 1.5rem; margin: 0;"><i class="fas fa-code"></i> Sistem Modular PHP OOP</h1>
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.1); padding: 8px 15px; border-radius: 20px;">
                    <div style="width: 35px; height: 35px; border-radius: 50%; background: white; color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div style="font-weight: 600;"><?php echo $_SESSION['user']['nama'] ?? 'Administrator'; ?></div>
                        <div style="font-size: 0.85rem; opacity: 0.9;"><?php echo $_SESSION['user']['role'] ?? 'Super Admin'; ?></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-layout">
            <?php include 'template/sidebar.php'; ?>
            
            <main class="app-content">
                <div class="content-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #edf2f7;">
                        <div>
                            <h1 style="color: var(--dark); font-size: 2rem; margin-bottom: 5px;">Dashboard Sistem</h1>
                            <p style="color: var(--gray); font-size: 1.1rem;">Laboratorium 11 - Pemrograman Web Lanjutan</p>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Home</a></li>
                                <li><?php echo ucfirst($mod); ?></li>
                                <?php if($page != 'index'): ?>
                                <li><?php echo ucfirst($page); ?></li>
                                <?php endif; ?>
                            </ol>
                        </nav>
                    </div>