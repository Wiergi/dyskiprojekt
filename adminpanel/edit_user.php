<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klient_id = $_POST['klient_id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $stmt = $pdo->prepare("
        UPDATE klienci 
        SET imie = ?, nazwisko = ?, email = ?, telefon = ?
        WHERE klient_id = ?
    ");
    $stmt->execute([$imie, $nazwisko, $email, $telefon, $klient_id]);

    header("Location: uzytkownicy.php");
    exit();
}
?>
