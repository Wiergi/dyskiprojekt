<?php
include 'config.php';

if (isset($_GET['id'])) {
    $klient_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM klienci WHERE klient_id = ?");
    $stmt->execute([$klient_id]);

    header("Location: uzytkownicy.php");
    exit();
}
?>
