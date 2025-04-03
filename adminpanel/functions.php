<?php
function checkAdminAuth() {
    session_start();
    
    // Jeśli użytkownik nie jest zalogowany, przekieruj do logowania
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
    
    // Opcjonalnie: Sprawdź czy sesja jest aktywna (zabezpieczenie przed hijacking)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        // 30 minut bez aktywności = wyloguj
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    $_SESSION['last_activity'] = time(); // Odśwież czas aktywności
}