<?php
session_start();

// Połączenie z bazą danych
$mysqli = new mysqli("localhost", "root", "", "dyski");

if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}

// Dane klienta - należy pobrać z formularza lub sesji
$klient_id = 5; // Przykładowy identyfikator klienta
$adres_dostawy_id = 1; // Przykładowy adres dostawy
$metoda_platnosci_id = 1; // Przykładowa metoda płatności
$data_zamowienia = date("Y-m-d H:i:s");
$status_id = 1; // Status "Nowe"

// Obliczenie ceny całkowitej
$cena_calkowita = 0;
foreach ($_SESSION['koszyk'] as $produkt_id => $ilosc) {
    $stmt = $mysqli->prepare("SELECT cena FROM produkty WHERE produkt_id = ?");
    $stmt->bind_param("i", $produkt_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produkt = $result->fetch_assoc();

    $cena_calkowita += $produkt['cena'] * $ilosc;
}

// Dodanie zamówienia do bazy
$stmt = $mysqli->prepare("INSERT INTO zamowienia (klient_id, data_zamowienia, status_id, metoda_platnosci_id, cena_calkowita, adres_dostawy_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiid", $klient_id, $data_zamowienia, $status_id, $metoda_platnosci_id, $cena_calkowita, $adres_dostawy_id);
$stmt->execute();
$zamowienie_id = $mysqli->insert_id;

// Dodanie pozycji zamówienia
foreach ($_SESSION['koszyk'] as $produkt_id => $ilosc) {
    $stmt = $mysqli->prepare("SELECT cena FROM produkty WHERE produkt_id = ?");
    $stmt->bind_param("i", $produkt_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produkt = $result->fetch_assoc();

    $cena_jednostkowa = $produkt['cena'];

    $stmt2 = $mysqli->prepare("INSERT INTO pozycjezamowienia (zamowienie_id, produkt_id, ilosc, cena_jednostkowa) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("iiid", $zamowienie_id, $produkt_id, $ilosc, $cena_jednostkowa);
    $stmt2->execute();
}

// Czyszczenie koszyka
unset($_SESSION['koszyk']);

echo "<h2>Zamówienie zostało złożone!</h2>";

$mysqli->close();
?>
