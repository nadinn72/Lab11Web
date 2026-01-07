<?php
// Start session
session_start();

// Include database class
require_once "class/Database.php";

// Redirect jika sudah login
if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

// Proses login
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validasi sederhana
    if(empty($email) || empty($password)) {
        $error = "Email dan password harus diisi!";
    } else {
        // Cek user di database
        $db = new Database();
        
        // Escape input untuk keamanan
        $safe_email = $db->escape($email);
        $safe_password = $db->escape($password);
        
        // Query: cek email dan password (SIMPLE - tanpa hashing)
        $sql = "SELECT * FROM users WHERE email = '$safe_email' AND pass = '$safe_password'";
        $result = $db->query($sql);
        
        if($result && $result->num_rows > 0) {
            $users = $result->fetch_assoc();
            
            // Set session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['id'] == 1 ? 'superadmin' : 'user'
            ];
            $_SESSION['user_logged_in'] = true;
            
            // Redirect ke dashboard
            header("Location: index.php");
            exit();
        } else {
            $error = "Email atau password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Modular PHP OOP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-title h1 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .error {
            background: #ffebee;
            color: #c00;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .demo-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
        }
        .demo-info h3 {
            color: #1976d2;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-title">
                <h1>🔐 Login System</h1>
                <p>Sistem Modular PHP OOP</p>
            </div>
            
            <?php if($error): ?>
            <div class="error">
                ⚠️ <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="admin@example.com"
                           required
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Masukkan password"
                           required>
                </div>
                
                <button type="submit" name="login" value="1" class="btn-login">
                    🚀 Login
                </button>
            </form>
            
            <div class="demo-info">
                <h3>💡 Info Login (untuk testing):</h3>
                <p><strong>Email:</strong> admin@example.com</p>
                <p><strong>Password:</strong> admin123</p>
                <p><strong>Email:</strong> nadiinputrii72@gmail.com</p>
                <p><strong>Password:</strong> nadine123</p>
            </div>
            
            <div class="footer">
                <p>Praktikum Pemrograman Web Lanjutan</p>
                <p>Universitas Pelita Bangsa</p>
            </div>
        </div>
    </div>
    
    <script>
        // Auto focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>
</html>