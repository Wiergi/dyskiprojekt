<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt_id = $_POST['produkt_id'];
    unset($_SESSION['koszyk'][$produkt_id]);

    header("Location: koszyk.php");
    exit();
}
?>
