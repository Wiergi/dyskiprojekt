<?php
include 'config.php';

if (isset($_GET['id'])) {
    $produkt_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM produkty WHERE produkt_id = ?");
    $stmt->execute([$produkt_id]);

    header("Location: produkty.php"); // Przekierowanie po usunięciu
    exit();
}
?>
