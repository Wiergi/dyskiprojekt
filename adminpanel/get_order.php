<?php
include 'config.php';

if (isset($_GET['id'])) {
    $zamowienie_id = $_GET['id'];

    $stmt = $pdo->prepare("
        SELECT 
            zamowienie_id,
            klient_id,
            data_zamowienia,
            status_id,
            cena_calkowita
        FROM zamowienia
        WHERE zamowienie_id = ?
    ");
    $stmt->execute([$zamowienie_id]);

    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($order);
} else {
    echo "Brak ID zamówienia.";
}
?>
