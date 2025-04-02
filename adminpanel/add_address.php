<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ulica = $_POST['ulica'];
    $numer_domu = $_POST['numer_domu'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $miasto = $_POST['miasto'];
    $kraj = 'Polska'; // Domyślny kraj

    // Dodanie adresu do bazy danych
    try {
        $stmt = $pdo->prepare("
            INSERT INTO adresy (ulica, numer_domu, kod_pocztowy, miasto, kraj)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$ulica, $numer_domu, $kod_pocztowy, $miasto, $kraj]);

        // Pobranie ID dodanego adresu
        $adres_id = $pdo->lastInsertId();

        echo "Adres dodany pomyślnie. ID: " . $adres_id;
        // Tutaj możesz zwrócić ID dodanego adresu, aby zaktualizować formularz
    } catch (PDOException $e) {
        echo "Wystąpił błąd: " . $e->getMessage();
    }
}
?>
