<aside class="app-sidebar">
    <div style="padding: 0 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
        <h2 style="font-size: 1.3rem; color: #a0aec0; font-weight: 500;">Menu Navigasi</h2>
    </div>
    
    <nav style="padding: 0 15px;">
        <ul style="list-style: none;">
            <!-- Dashboard - SEMUA USER (admin dan user biasa) -->
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>index.php" 
                   style="color: <?php echo $module == 'home' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'home' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'home' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-tachometer-alt" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Dashboard
                </a>
            </li>
            
            <!-- Content Management - SEMUA USER -->
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Content Management
            </li>
            
            <!-- Artikel - SEMUA USER -->
            <li style="margin-bottom: 5px;">
                <a href="/lab11_php_oop/artikel/index"
                   style="color: <?php echo $module == 'artikel' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'artikel' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'artikel' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-newspaper" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Artikel
                </a>
            </li>
            
            <!-- Management User - HANYA ADMIN -->
            <?php if(isset($_SESSION['users']['role']) && $_SESSION['users']['role'] == 'admin'): ?>
            <li style="margin-bottom: 5px;">
                <a href="/lab11_php_oop/users/index" 
                   style="color: <?php echo $module == 'users' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'users' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'users' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-users-cog" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Management User
                </a>
            </li>
            <?php endif; ?>
            
            <!-- Kategori - SEMUA USER -->
            <li style="margin-bottom: 5px;">
                <a href="/lab11_php_oop/categories/index" 
                   style="color: <?php echo $module == 'categories' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'categories' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'categories' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-tags" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Kategori
                </a>
            </li>
            
            <!-- Menu Admin Settings - HANYA ADMIN -->
            <?php if(isset($_SESSION['users']['role']) && $_SESSION['users']['role'] == 'admin'): ?>
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Admin Settings
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>module/settings" 
                   style="color: <?php echo $module == 'settings' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'settings' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'settings' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-cog" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> System Settings
                </a>
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>module/logs" 
                   style="color: <?php echo $module == 'logs' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'logs' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'logs' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-history" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Activity Log
                </a>
            </li>
            <?php else: ?>
            <!-- Menu untuk User Biasa (selain admin) -->
            <?php if(isset($_SESSION['users']['id']) && $_SESSION['users']['id'] !== null && $_SESSION['users']['role'] != 'admin'): ?>
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                User Menu
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>module/users/profile" 
                   style="color: <?php echo $module == 'user' && $page == 'profile' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'user' && $page == 'profile' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'user' && $page == 'profile' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-user-circle" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> My Profile
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            
            <!-- Menu Profile untuk Admin (jika belum ada di atas) -->
            <?php if(isset($_SESSION['users']['id']) && $_SESSION['users']['id'] !== null && $_SESSION['users']['role'] == 'admin'): ?>
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Admin Menu
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>module/users/profile" 
                   style="color: <?php echo $module == 'user' && $page == 'profile' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $module == 'user' && $page == 'profile' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $module == 'user' && $page == 'profile' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-user-circle" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> My Profile
                </a>
            </li>
            <?php endif; ?>
            
            <!-- Authentication Links -->
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Authentication
            </li>
            
            <?php if(!isset($_SESSION['users']['id']) || $_SESSION['users']['id'] === null): ?>
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>login.php" 
                   style="color: <?php echo $page == 'login' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $page == 'login' ? 'linear-gradient(135deg, var(--secondary) 0%, #38a169 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $page == 'login' ? '0 4px 6px rgba(72, 187, 120, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-sign-in-alt" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Login
                </a>
            </li>
            <?php else: ?>
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>logout.php" 
                   style="color: <?php echo $page == 'logout' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $page == 'logout' ? 'linear-gradient(135deg, var(--danger) 0%, #c53030 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $page == 'logout' ? '0 4px 6px rgba(245, 101, 101, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-sign-out-alt" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Logout
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div style="padding: 20px; margin-top: auto;">
        <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
            <h3 style="font-size: 0.9rem; color: #a0aec0; margin-bottom: 10px;">Info Sistem</h3>
            <p style="font-size: 0.85rem; line-height: 1.4;">
                <strong>Modul:</strong> <?php echo ucfirst($module); ?><br>
                <strong>Halaman:</strong> <?php echo ucfirst($page); ?><br>
                <strong>User:</strong> <?php echo $_SESSION['users']['nama'] ?? 'Guest'; ?><br>
                <strong>Role:</strong> 
                <?php if(isset($_SESSION['users']['role'])): ?>
                    <span class="<?php echo $_SESSION['users']['role'] == 'admin' ? 'status-admin' : 'status-user'; ?>" style="padding: 2px 6px; font-size: 0.7rem;">
                        <?php echo ucfirst($_SESSION['users']['role']); ?>
                    </span>
                <?php else: ?>
                    <span style="color: #cbd5e0; font-style: italic;">Not Logged In</span>
                <?php endif; ?>
            </p>
        </div>
    </div>
</aside>