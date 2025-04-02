<?php
include 'config.php';

if (isset($_GET['id'])) {
    $klient_id = $_GET['id'];

    $stmt = $pdo->prepare("
        SELECT 
            klient_id, 
            imie, 
            nazwisko, 
            email, 
            telefon
        FROM klienci
        WHERE klient_id = ?
    ");
    $stmt->execute([$klient_id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($user);
} else {
    echo "Brak ID użytkownika.";
}
?>
