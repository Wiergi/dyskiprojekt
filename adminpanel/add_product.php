<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $typ = $_POST['typ'];
    $pojemnosc = $_POST['pojemnosc'];
    $producent = $_POST['producent'];
    $cena = $_POST['cena'];
    $ilosc = $_POST['ilosc'];

    $stmt = $pdo->prepare("
        INSERT INTO produkty (nazwa, typ_id, pojemnosc_id, producent_id, cena, ilosc_w_magazynie, data_dodania)
        VALUES (?, ?, ?, ?, ?, ?, CURDATE())
    ");
    $stmt->execute([$nazwa, $typ, $pojemnosc, $producent, $cena, $ilosc]);

    header("Location: produkty.php"); // Przekierowanie po dodaniu
    exit();
}
?>
