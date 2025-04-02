<?php
include 'config.php';

$stmt = $pdo->query("
    SELECT 
        p.produkt_id, 
        p.nazwa, 
        t.nazwa AS typ_nazwa,
        po.wartość AS pojemnosc,
        po.jednostka AS pojemnosc_jednostka,
        pr.nazwa AS producent_nazwa, 
        p.cena, 
        p.ilosc_w_magazynie
    FROM produkty p
    JOIN typydyskow t ON p.typ_id = t.typ_id
    JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id
    JOIN producenci pr ON p.producent_id = pr.producent_id
");
$produkty = $stmt->fetchAll();

?><!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny - Produkty</title>
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
        <h2>Produkty</h2>

        <section>
            <h3>Lista produktów</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Typ</th>
                        <th>Pojemność</th>
                        <th>Producent</th>
                        <th>Cena</th>
                        <th>Stan</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($produkty as $produkt): ?>
                    <tr>
                        <td><?= $produkt['produkt_id'] ?></td>
                        <td><?= $produkt['nazwa'] ?></td>
                        <td><?= $produkt['typ_nazwa'] ?></td>
                        <td><?= $produkt['pojemnosc'] . ' ' . $produkt['pojemnosc_jednostka'] ?></td>
                        <td><?= $produkt['producent_nazwa'] ?></td>
                        <td><?= $produkt['cena'] ?> zł</td>
                        <td><?= $produkt['ilosc_w_magazynie'] ?></td>
                        <td>
                        <button onclick="openEditForm(<?= $produkt['produkt_id'] ?>)">Edytuj</button>
                        <button onclick="deleteProduct(<?= $produkt['produkt_id'] ?>)">Usuń</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="editForm" style="display:none;">
    <h3>Edycja produktu</h3>
    <form id="productForm" action="edit_product.php" method="POST">
        <input type="hidden" id="produkt_id" name="produkt_id">

        <label for="nazwa">Nazwa:</label>
        <input type="text" id="nazwa" name="nazwa" required><br><br>

        <label for="typ">Typ:</label>
            <select id="typ" name="typ" required>
                <option value="1">HDD</option>
                <option value="2">SSD</option>
                <option value="3">SSD NVMe</option>
                <option value="4">SSD SATA</option>
                <option value="5">SSD M.2</option>
            </select><br><br>

            <label for="pojemnosc">Pojemność:</label>
            <select id="pojemnosc" name="pojemnosc" required>
                <option value="1">128 GB</option>
                <option value="2">256 GB</option>
                <option value="3">512 GB</option>
                <option value="4">1024 GB</option>
                <option value="5">2048 GB</option>
                <option value="6">4096 GB</option>
                <option value="7">8192 GB</option>
            </select><br><br>

            <label for="producent">Producent:</label>
            <select id="producent" name="producent" required>
                <option value="1">Seagate</option>
                <option value="2">Western Digital</option>
                <option value="3">Samsung</option>
                <option value="4">Toshiba</option>
                <option value="5">Kingston</option>
            </select><br><br>

            <label for="cena">Cena:</label>
            <input type="number" id="cena" name="cena" step="0.01" required><br><br>

            <label for="ilosc">Ilość:</label>
            <input type="number" id="ilosc" name="ilosc" required><br><br>

        <button type="submit">Zapisz</button>
        <button type="button" onclick="closeEditForm()">Anuluj</button>
    </form>
</section>
<section>
    <h3>Dodaj nowy produkt</h3>
    <button onclick="openAddForm()">Dodaj produkt</button>

    <div id="addForm" style="display:none;">
        <form id="addProductForm" action="add_product.php" method="POST">
            <label for="nazwa">Nazwa:</label>
            <input type="text" id="nazwa" name="nazwa" required><br><br>

            <label for="typ">Typ:</label>
            <select id="typ" name="typ" required>
                <option value="1">HDD</option>
                <option value="2">SSD</option>
                <option value="3">SSD NVMe</option>
                <option value="4">SSD SATA</option>
                <option value="5">SSD M.2</option>
            </select><br><br>

            <label for="pojemnosc">Pojemność:</label>
            <select id="pojemnosc" name="pojemnosc" required>
                <option value="1">128 GB</option>
                <option value="2">256 GB</option>
                <option value="3">512 GB</option>
                <option value="4">1024 GB</option>
                <option value="5">2048 GB</option>
                <option value="6">4096 GB</option>
                <option value="7">8192 GB</option>
            </select><br><br>

            <label for="producent">Producent:</label>
            <select id="producent" name="producent" required>
                <option value="1">Seagate</option>
                <option value="2">Western Digital</option>
                <option value="3">Samsung</option>
                <option value="4">Toshiba</option>
                <option value="5">Kingston</option>
            </select><br><br>

            <label for="cena">Cena:</label>
            <input type="number" id="cena" name="cena" step="0.01" required><br><br>

            <label for="ilosc">Ilość:</label>
            <input type="number" id="ilosc" name="ilosc" required><br><br>

            <button type="submit">Dodaj produkt</button>
            <button type="button" onclick="closeAddForm()">Anuluj</button>
        </form>
    </div>
</section>

<script>
    function openAddForm() {
        document.getElementById('addForm').style.display = 'block';
    }

    function closeAddForm() {
        document.getElementById('addForm').style.display = 'none';
    }
</script>


    </main>

    <script>
        function openEditForm(id) {
            // Tutaj dodaj kod, który pobierze dane produktu z bazy i wstawi do formularza
            document.getElementById('produkt_id').value = id;
            // Możesz użyć AJAX, aby pobrać dane produktu i wstawić je do formularza
            document.getElementById('editForm').style.display = 'block';
        }

        function closeEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
        function deleteProduct(id) {
    if (confirm('Czy na pewno chcesz usunąć ten produkt?')) {
        // Przekierowanie do pliku PHP, który usunie produkt
        window.location.href = 'delete_product.php?id=' + id;
    }
}

    </script>

</body>
</html>
