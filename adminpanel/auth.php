<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Poprawione dane dostępowe (XAMPP domyślnie)
        $db = new PDO('mysql:host=localhost;dbname=dyski', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT id, password_hash FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $username;
            session_regenerate_id(true);
            header('Location: index.php');
            exit;
        } else {
            header('Location: login.php?error=1');
            exit;
        }
    } catch (PDOException $e) {
        die("Błąd bazy danych: " . $e->getMessage());
    }
}