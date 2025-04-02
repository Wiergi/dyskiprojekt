<?php
include 'config.php';

if (isset($_GET['id'])) {
    $zamowienie_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM zamowienia WHERE zamowienie_id = ?");
    $stmt->execute([$zamowienie_id]);

    header("Location: zamowienia.php");
    exit();
}
?>
