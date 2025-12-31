<aside class="app-sidebar">
    <div style="padding: 0 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
        <h2 style="font-size: 1.3rem; color: #a0aec0; font-weight: 500;">Menu Navigasi</h2>
    </div>
    
    <nav style="padding: 0 15px;">
        <ul style="list-style: none;">
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url(); ?>" 
                   style="color: <?php echo $mod == 'home' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'home' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'home' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-tachometer-alt" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Dashboard
                </a>
            </li>
            
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Content Management
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url('artikel/index'); ?>" 
                   style="color: <?php echo $mod == 'artikel' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'artikel' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'artikel' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-newspaper" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Artikel
                </a>
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url('users'); ?>" 
                   style="color: <?php echo $mod == 'users' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'users' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'users' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-users" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Management User
                </a>
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url('categories'); ?>" 
                   style="color: <?php echo $mod == 'categories' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'categories' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'categories' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-tags" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Kategori
                </a>
            </li>
            
            <li style="padding: 15px 20px; color: #718096; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                Settings
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url('settings'); ?>" 
                   style="color: <?php echo $mod == 'settings' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'settings' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'settings' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-cog" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Pengaturan
                </a>
            </li>
            
            <li style="margin-bottom: 5px;">
                <a href="<?php echo base_url('logs'); ?>" 
                   style="color: <?php echo $mod == 'logs' ? 'white' : '#cbd5e0'; ?>; 
                          text-decoration: none; 
                          display: flex; 
                          align-items: center; 
                          padding: 12px 20px; 
                          border-radius: 8px; 
                          transition: all 0.3s ease;
                          background: <?php echo $mod == 'logs' ? 'linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%)' : 'transparent'; ?>;
                          box-shadow: <?php echo $mod == 'logs' ? '0 4px 6px rgba(102, 126, 234, 0.2)' : 'none'; ?>;">
                    <i class="fas fa-history" style="margin-right: 12px; font-size: 1.2rem; width: 20px; text-align: center;"></i> Activity Log
                </a>
            </li>
        </ul>
    </nav>
    
    <div style="padding: 20px; margin-top: auto;">
        <div style="background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px;">
            <h3 style="font-size: 0.9rem; color: #a0aec0; margin-bottom: 10px;">Info Sistem</h3>
            <p style="font-size: 0.85rem; line-height: 1.4;">
                <strong>Modul:</strong> <?php echo ucfirst($mod); ?><br>
                <strong>Halaman:</strong> <?php echo ucfirst($page); ?><br>
                <strong>User:</strong> <?php echo $_SESSION['user']['nama'] ?? 'Administrator'; ?><br>
                <strong>Role:</strong> <?php echo $_SESSION['user']['role'] ?? 'Super Admin'; ?>
            </p>
        </div>
    </div>
</aside>