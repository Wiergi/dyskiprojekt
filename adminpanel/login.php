<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie | Panel Administracyjny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 25px;
            border-bottom: none;
        }
        
        .card-body {
            padding: 30px;
            background-color: white;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background-color: white;
            border-right: none;
        }
        
        .form-floating input {
            border-left: none;
        }
        
        .logo {
            width: 80px;
            margin-bottom: 15px;
        }
        
        .error-message {
            animation: shake 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card login-card">
            <div class="card-header">
                <img src="../photos/logo.svg" alt="Logo" class="logo">
                <h3><i class="fas fa-lock"></i> Logowanie</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger error-message">
                        <i class="fas fa-exclamation-circle"></i> Błędny login lub hasło!
                    </div>
                <?php endif; ?>
                
                <form action="auth.php" method="POST">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Login" required autofocus>
                                <label for="username">Login</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Hasło" required>
                                <label for="password">Hasło</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt"></i> Zaloguj się
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="footer">
            &copy; <?= date('Y') ?> Panel Administracyjny | Wersja 1.0 <br>
            Bartosz Wiergan
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prosta walidacja po stronie klienta
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('Proszę wypełnić wszystkie pola!');
            }
        });
    </script>
</body>
</html>