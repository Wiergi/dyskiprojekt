<?php
include 'config.php';

// Pobranie listy użytkowników z bazy danych
$stmt = $pdo->query("SELECT * FROM klienci");
$uzytkownicy = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny - Użytkownicy</title>
    <link rel="stylesheet" href="styleadmin.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA1bYrHo1KF68x0UIXJnDqFtKmlNSGjZE&libraries=places&callback=initAutocomplete" async defer></script>
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
        <h2>Użytkownicy</h2>

        <section>
            <h3>Lista użytkowników</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Data rejestracji</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($uzytkownicy as $uzytkownik): ?>
                    <tr>
                        <td><?= $uzytkownik['klient_id'] ?></td>
                        <td><?= $uzytkownik['imie'] ?></td>
                        <td><?= $uzytkownik['nazwisko'] ?></td>
                        <td><?= $uzytkownik['email'] ?></td>
                        <td><?= $uzytkownik['telefon'] ?></td>
                        <td><?= $uzytkownik['data_rejestracji'] ?></td>
                        <td>
                            <button onclick="openEditForm(<?= $uzytkownik['klient_id'] ?>)">Edytuj</button>
                            <button onclick="deleteUser(<?= $uzytkownik['klient_id'] ?>)">Usuń</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="editForm" style="display:none;">
            <h3>Edycja użytkownika</h3>
            <form id="userForm" action="edit_user.php" method="POST">
                <input type="hidden" id="klient_id" name="klient_id">

                <label for="imie">Imię:</label>
                <input type="text" id="imie" name="imie" required><br><br>

                <label for="nazwisko">Nazwisko:</label>
                <input type="text" id="nazwisko" name="nazwisko" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="telefon">Telefon:</label>
                <input type="text" id="telefon" name="telefon"><br><br>

                <button type="submit">Zapisz</button>
                <button type="button" onclick="closeEditForm()">Anuluj</button>
            </form>
        </section>
        <section>
    <h3>Dodaj nowego użytkownika</h3>
    <button onclick="openAddForm()">Dodaj użytkownika</button>

    <div id="addForm" style="display:none;">
        <form id="addUserForm" action="add_user.php" method="POST">
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie" required><br><br>

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon"><br><br>

            <label for="data_rejestracji">Data rejestracji:</label>
            <input type="date" id="data_rejestracji" name="data_rejestracji" required><br><br>

            <label for="adres_id">Adres:</label>
            <label for="ulica">Ulica:</label>
            <input type="text" id="ulica" name="ulica" required><br><br>

            <label for="numer_domu">Numer domu:</label>
            <input type="text" id="numer_domu" name="numer_domu" required><br><br>

            <label for="kod_pocztowy">Kod pocztowy:</label>
            <input type="text" id="kod_pocztowy" name="kod_pocztowy" required><br><br>

            <label for="miasto">Miasto:</label>
            <input type="text" id="miasto" name="miasto" required><br><br>
            </select><br><br>

            <button type="submit">Dodaj użytkownika</button>
            <button type="button" onclick="closeAddForm()">Anuluj</button>
        </form>
    </div>
</section>
    </main>

    <script>
        function openEditForm(id) {
            // Pobranie danych użytkownika za pomocą AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_user.php?id=' + id, true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var user = JSON.parse(xhr.responseText);

                    // Wstawienie danych do formularza
                    document.getElementById('klient_id').value = user.klient_id;
                    document.getElementById('imie').value = user.imie;
                    document.getElementById('nazwisko').value = user.nazwisko;
                    document.getElementById('email').value = user.email;
                    document.getElementById('telefon').value = user.telefon;

                    document.getElementById('editForm').style.display = 'block';
                } else {
                    alert('Wystąpił błąd podczas pobierania danych użytkownika.');
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

        function deleteUser(id) {
            if (confirm('Czy na pewno chcesz usunąć tego użytkownika?')) {
                window.location.href = 'delete_user.php?id=' + id;
            }
        }
        function openAddForm() {
        document.getElementById('addForm').style.display = 'block';
    }

    function closeAddForm() {
        document.getElementById('addForm').style.display = 'none';
    }
    function initAutocomplete() {
    var ulicaInput = document.getElementById('ulica');
    var miastoInput = document.getElementById('miasto');
    var kodPocztowyInput = document.getElementById('kod_pocztowy');
    var numerDomuInput = document.getElementById('numer_domu');

    var autocomplete = new google.maps.places.Autocomplete(ulicaInput, {
        types: ['address'],
        componentRestrictions: {country: 'pl'} // Ograniczenie do Polski
    });

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();

        if (!place.geometry) {
            ulicaInput.placeholder = 'Wpisz ulicę';
            return;
        }

        var ulica = '';
        var numerDomu = '';
        var kodPocztowy = '';
        var miasto = '';

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (addressType == 'street_number') {
                numerDomu = place.address_components[i].long_name;
                numerDomuInput.value = numerDomu;
            } else if (addressType == 'route') {
                ulica = place.address_components[i].long_name;
                ulicaInput.value = ulica;
            } else if (addressType == 'postal_code') {
                kodPocztowy = place.address_components[i].long_name;
                kodPocztowyInput.value = kodPocztowy;
            } else if (addressType == 'locality') {
                miasto = place.address_components[i].long_name;
                miastoInput.value = miasto;
            }
        }

        // Wyślij dane do serwera
        addAddressToDatabase(ulica, numerDomu, kodPocztowy, miasto);
    });
}

function addAddressToDatabase(ulica, numerDomu, kodPocztowy, miasto) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_address.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log('Adres dodany do bazy danych.');
            // Tutaj możesz zaktualizować pole adres_id w formularzu dodawania użytkownika
            // lub wyświetlić komunikat o sukcesie
        } else {
            alert('Wystąpił błąd podczas dodawania adresu do bazy danych.');
        }
    };

    xhr.onerror = function() {
        alert('Wystąpił błąd sieciowy.');
    };

    var params = 'ulica=' + encodeURIComponent(ulica) +
                 '&numer_domu=' + encodeURIComponent(numerDomu) +
                 '&kod_pocztowy=' + encodeURIComponent(kodPocztowy) +
                 '&miasto=' + encodeURIComponent(miasto);

    xhr.send(params);
}

    </script>

</body>
</html>
