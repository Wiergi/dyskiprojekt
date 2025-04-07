<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $ilosc = $_POST['ilosc'];

    if (isset($_SESSION['koszyk'][$product_id])) {
        $_SESSION['koszyk'][$product_id] += $ilosc;
    } else {
        $_SESSION['koszyk'][$product_id] = $ilosc;
    }

    header("Location: koszyk.php"); // Przekierowanie do strony koszyka
    exit();
}
?>
