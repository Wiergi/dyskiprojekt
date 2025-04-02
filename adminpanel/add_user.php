<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $data_rejestracji = $_POST['data_rejestracji'];
    $adres_id = $_POST['adres_id'];

    // Dodanie użytkownika do bazy danych
    $stmt = $pdo->prepare("
        INSERT INTO klienci (imie, nazwisko, email, telefon, data_rejestracji, adres_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$imie, $nazwisko, $email, $telefon, $data_rejestracji, $adres_id]);

    // Przekierowanie po dodaniu
    header("Location: uzytkownicy.php");
    exit();
}
?>
