<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt_id = $_POST['produkt_id'];
    $ilosc = $_POST['ilosc'];

    if ($ilosc > 0) {
        $_SESSION['koszyk'][$produkt_id] = $ilosc;
    } else {
        unset($_SESSION['koszyk'][$produkt_id]);
    }

    header("Location: koszyk.php");
    exit();
}
?>
