<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zamowienie_id = $_POST['zamowienie_id'];
    $status_id = $_POST['status'];
    $cena_calkowita = $_POST['wartosc'];

    $stmt = $pdo->prepare("
        UPDATE zamowienia 
        SET status_id = ?, cena_calkowita = ?
        WHERE zamowienie_id = ?
    ");
    $stmt->execute([$status_id, $cena_calkowita, $zamowienie_id]);

    header("Location: zamowienia.php");
    exit();
}
?>
