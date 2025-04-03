<?php
include 'config.php';

// Pobranie zamówień z bazy danych
$stmt = $pdo->query("
    SELECT 
        z.zamowienie_id,
        z.klient_id,
        z.data_zamowienia,
        z.cena_calkowita,
        s.nazwa AS status_nazwa,
        k.imie AS klient_imie,
        k.nazwisko AS klient_nazwisko
    FROM zamowienia z
    JOIN statusyzamowienia s ON z.status_id = s.status_id
    JOIN klienci k ON z.klient_id = k.klient_id
");
$zamowienia = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny - Zamówienia</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>

    <header>
        <h1>Panel Administracyjny</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="produkty.php">Produkty</a></li>
                <li><a href="zamowienia.php">Zamówienia</a></li>
                <li><a href="uzytkownicy.php">Użytkownicy</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Zamówienia</h2>

        <section>
            <h3>Lista zamówień</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Klient</th>
                        <th>Data</th>
                        <th>Wartość</th>
                        <th>Status</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zamowienia as $zamowienie): ?>
                    <tr>
                        <td><?= $zamowienie['zamowienie_id'] ?></td>
                        <td><?= $zamowienie['klient_imie'] . ' ' . $zamowienie['klient_nazwisko'] ?></td>
                        <td><?= $zamowienie['data_zamowienia'] ?></td>
                        <td><?= $zamowienie['cena_calkowita'] ?> zł</td>
                        <td><?= $zamowienie['status_nazwa'] ?></td>
                        <td>
                            <button onclick="openEditForm(<?= $zamowienie['zamowienie_id'] ?>)">Edytuj</button>
                            <button onclick="deleteOrder(<?= $zamowienie['zamowienie_id'] ?>)">Usuń</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h3>Dodaj nowe zamówienie</h3>
            <button onclick="openAddForm()">Dodaj zamówienie</button>

            <div id="addForm" style="display:none;">
                <form id="addOrderForm" action="add_order.php" method="POST">
                    <label for="klient_id">Klient:</label>
                    <select id="klient_id" name="klient_id" required>
                        <?php
                        // Pobierz listę klientów z bazy danych
                        $stmt_klienci = $pdo->query("SELECT klient_id, CONCAT(imie, ' ', nazwisko) AS klient_nazwa FROM klienci");
                        $klienci = $stmt_klienci->fetchAll();
                        foreach ($klienci as $klient) {
                            echo "<option value='{$klient['klient_id']}'>{$klient['klient_nazwa']}</option>";
                        }
                        ?>
                    </select><br><br>

                    <label for="status_id">Status:</label>
                    <select id="status_id" name="status_id" required>
                        <?php
                        // Pobierz listę statusów z bazy danych
                        $stmt_statusy = $pdo->query("SELECT status_id, nazwa FROM statusyzamowienia");
                        $statusy = $stmt_statusy->fetchAll();
                        foreach ($statusy as $status) {
                            echo "<option value='{$status['status_id']}'>{$status['nazwa']}</option>";
                        }
                        ?>
                    </select><br><br>

                    <label for="metoda_platnosci_id">Metoda płatności:</label>
                    <select id="metoda_platnosci_id" name="metoda_platnosci_id" required>
                        <?php
                        // Pobierz listę metod płatności z bazy danych
                        $stmt_metody = $pdo->query("SELECT metoda_id, nazwa FROM metodyplatnosci");
                        $metody = $stmt_metody->fetchAll();
                        foreach ($metody as $metoda) {
                            echo "<option value='{$metoda['metoda_id']}'>{$metoda['nazwa']}</option>";
                        }
                        ?>
                    </select><br><br>

                    <label for="adres_dostawy_id">Adres dostawy:</label>
                    <select id="adres_dostawy_id" name="adres_dostawy_id" required>
                        <?php
                        // Pobierz listę adresów z bazy danych
                        $stmt_adresy = $pdo->query("SELECT adres_id, CONCAT(ulica, ' ', numer_domu, ', ', miasto) AS adres_nazwa FROM adresy");
                        $adresy = $stmt_adresy->fetchAll();
                        foreach ($adresy as $adres) {
                            echo "<option value='{$adres['adres_id']}'>{$adres['adres_nazwa']}</option>";
                        }
                        ?>
                    </select><br><br>

                    <label for="cena_calkowita">Wartość zamówienia w zł:</label>
                    <input type="number" id="cena_calkowita" name="cena_calkowita" step="0.01" required><br><br>

                    <button type="submit">Dodaj zamówienie</button>
                    <button type="button" onclick="closeAddForm()">Anuluj</button>
                </form>
            </div>
        </section>

        <section id="editForm" style="display:none;">
            <h3>Edycja zamówienia</h3>
            <form id="orderForm" action="edit_order.php" method="POST">
                <input type="hidden" id="zamowienie_id" name="zamowienie_id">

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <?php
                    // Pobierz statusy zamówień z bazy danych
                    $stmt_statusy = $pdo->query("SELECT status_id, nazwa FROM statusyzamowienia");
                    $statusy = $stmt_statusy->fetchAll();
                    foreach ($statusy as $status):
                    ?>
                        <option value="<?= $status['status_id'] ?>"><?= $status['nazwa'] ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="wartosc">Wartość w zł:</label>
                <input type="number" id="wartosc" name="wartosc"><br><br>

                <button type="submit">Zapisz</button>
                <button type="button" onclick="closeEditForm()">Anuluj</button>
            </form>
        </section>
    </main>

    <script>
        function openEditForm(id) {
            // Pobranie danych zamówienia za pomocą AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_order.php?id=' + id, true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var order = JSON.parse(xhr.responseText);

                    // Wstawienie danych do formularza
                    document.getElementById('zamowienie_id').value = order.zamowienie_id;
                    document.getElementById('status').value = order.status_id;
                    document.getElementById('wartosc').value = order.cena_calkowita;

                    document.getElementById('editForm').style.display = 'block';
                } else {
                    alert('Wystąpił błąd podczas pobierania danych zamówienia.');
                }
            };

            xhr.onerror = function() {
                alert('Wystąpił błąd sieciowy.');
            };

            xhr.send();
        }

        function closeEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }

        function deleteOrder(id) {
            if (confirm('Czy na pewno chcesz usunąć to zamówienie?')) {
                window.location.href = 'delete_order.php?id=' + id;
            }
        }

        function openAddForm() {
            document.getElementById('addForm').style.display = 'block';
        }

        function closeAddForm() {
            document.getElementById('addForm').style.display = 'none';
        }
    </script>

</body>
</html>
