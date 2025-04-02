<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt_id = $_POST['produkt_id'];
    $nazwa = $_POST['nazwa'];
    $typ = $_POST['typ'];
    $pojemnosc = $_POST['pojemnosc'];
    $producent = $_POST['producent'];
    $cena = $_POST['cena'];
    $ilosc = $_POST['ilosc'];

    $stmt = $pdo->prepare("UPDATE produkty SET nazwa=?, typ_id=?, pojemnosc_id=?, producent_id=?, cena=?, ilosc_w_magazynie=? WHERE produkt_id=?");
    $stmt->execute([$nazwa, $typ, $pojemnosc, $producent, $cena, $ilosc, $produkt_id]);

    header("Location: produkty.php"); // Przekierowanie po edycji
    exit();
}
?>
