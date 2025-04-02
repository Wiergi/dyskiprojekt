<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $klient_id = $_POST['klient_id'];
    $status_id = $_POST['status_id'];
    $metoda_platnosci_id = $_POST['metoda_platnosci_id'];
    $adres_dostawy_id = $_POST['adres_dostawy_id'];
    $cena_calkowita = $_POST['cena_calkowita'];

    // Dodanie zamówienia do bazy danych
    $stmt = $pdo->prepare("
        INSERT INTO zamowienia (klient_id, data_zamowienia, status_id, metoda_platnosci_id, cena_calkowita, adres_dostawy_id)
        VALUES (?, NOW(), ?, ?, ?, ?)
    ");
    $stmt->execute([$klient_id, $status_id, $metoda_platnosci_id, $cena_calkowita, $adres_dostawy_id]);

    // Przekierowanie po dodaniu
    header("Location: zamowienia.php");
    exit();
}
?>
