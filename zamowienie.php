<?php
session_start();

// Połączenie z bazą danych (zastąp swoimi danymi)
$mysqli = new mysqli("localhost", "root", "", "dyski");
if ($mysqli->connect_error) {
    die("Błąd połączenia z bazą danych: " . $mysqli->connect_error);
}

// Obsługa formularza zamówienia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // ... (Kod obsługi formularza pozostaje bez większych zmian) ...
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $ulica = $_POST['ulica'];  //Te wartości mogą być puste, bo Google Maps ma je autouzupełnić
    $numer_domu = $_POST['numer_domu']; //Te wartości mogą być puste, bo Google Maps ma je autouzupełnić
    $numer_mieszkania = $_POST['numer_mieszkania'];
    $kod_pocztowy = $_POST['kod_pocztowy'];  //Te wartości mogą być puste, bo Google Maps ma je autouzupełnić
    $miasto = $_POST['miasto']; //Te wartości mogą być puste, bo Google Maps ma je autouzupełnić
    $kraj = $_POST['kraj'];
    $metoda_platnosci_id = $_POST['metoda_platnosci'];

    //Walidacja danych (dodaj bardziej szczegółową walidację)
    if (empty($imie) || empty($nazwisko) || empty($email) || empty($ulica) || empty($numer_domu) || empty($kod_pocztowy) || empty($miasto)) {
        echo "Wypełnij wszystkie wymagane pola.";
        exit;
    }
    // ... (reszta kodu obsługi formularza) ...
}
$mysqli->begin_transaction();

try {
    //1. Dodanie adresu do tabeli 'adresy'
    $stmt = $mysqli->prepare("INSERT INTO adresy (ulica, numer_domu, numer_mieszkania, kod_pocztowy, miasto, kraj) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $ulica, $numer_domu, $numer_mieszkania, $kod_pocztowy, $miasto, $kraj);
    $stmt->execute();
    $adres_id = $mysqli->insert_id;

    //2. Dodanie klienta do tabeli 'klienci' (zakładam, że klient nie ma jeszcze konta)
    $data_rejestracji = date("Y-m-d"); //Dzisiejsza data
    $stmt = $mysqli->prepare("INSERT INTO klienci (imie, nazwisko, email, telefon, data_rejestracji, adres_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $imie, $nazwisko, $email, $telefon, $data_rejestracji, $adres_id);
    $stmt->execute();
    $klient_id = $mysqli->insert_id;

    //3. Dodanie zamówienia do tabeli 'zamowienia'
    $data_zamowienia = date("Y-m-d H:i:s");
    $status_id = 1; //Status "Nowe"
    $cena_calkowita = 0; //Obliczana poniżej
    //Obliczanie ceny całkowitej zamówienia na podstawie koszyka
    foreach ($_SESSION['koszyk'] as $produkt_id => $ilosc) {
        $stmt = $mysqli->prepare("SELECT cena FROM produkty WHERE produkt_id = ?");
        $stmt->bind_param("i", $produkt_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produkt = $result->fetch_assoc();
        $cena_calkowita += $produkt['cena'] * $ilosc;
    }

    $stmt = $mysqli->prepare("INSERT INTO zamowienia (klient_id, data_zamowienia, status_id, metoda_platnosci_id, cena_calkowita, adres_dostawy_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiid", $klient_id, $data_zamowienia, $status_id, $metoda_platnosci_id, $cena_calkowita, $adres_id);
    $stmt->execute();
    $zamowienie_id = $mysqli->insert_id;

    //4. Dodanie pozycji zamówienia do tabeli 'pozycjezamowienia' i aktualizacja stanu magazynowego
    foreach ($_SESSION['koszyk'] as $produkt_id => $ilosc) {
        $stmt = $mysqli->prepare("SELECT cena, ilosc_w_magazynie FROM produkty WHERE produkt_id = ?");
        $stmt->bind_param("i", $produkt_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produkt = $result->fetch_assoc();
        $cena_jednostkowa = $produkt['cena'];

        //Sprawdzenie, czy jest wystarczająca ilość produktu w magazynie
        if ($produkt['ilosc_w_magazynie'] < $ilosc) {
            throw new Exception("Niewystarczająca ilość produktu o ID: " . $produkt_id . " w magazynie.");
        }

        $stmt2 = $mysqli->prepare("INSERT INTO pozycjezamowienia (zamowienie_id, produkt_id, ilosc, cena_jednostkowa) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("iiid", $zamowienie_id, $produkt_id, $ilosc, $cena_jednostkowa);
        $stmt2->execute();

        //Aktualizacja stanu magazynowego
        $nowa_ilosc = $produkt['ilosc_w_magazynie'] - $ilosc;
        $stmt3 = $mysqli->prepare("UPDATE produkty SET ilosc_w_magazynie = ? WHERE produkt_id = ?");
        $stmt3->bind_param("ii", $nowa_ilosc, $produkt_id);
        $stmt3->execute();
    }

    //Zatwierdzenie transakcji
    $mysqli->commit();

    //Czyszczenie koszyka
    unset($_SESSION['koszyk']);

    echo "<p>Dziękujemy za złożenie zamówienia. Numer Twojego zamówienia to: " . $zamowienie_id . "</p>";

} catch (Exception $e) {
    //Wycofanie transakcji w przypadku błędu
    $mysqli->rollback();
    echo "Wystąpił błąd podczas składania zamówienia: " . $e->getMessage();
}
$metody_platnosci_result = $mysqli->query("SELECT metoda_id, nazwa FROM metodyplatnosci");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Składanie Zamówienia</title>
    <link rel="stylesheet" type="text/css" href="stylez.css">
    <!-- Dodaj bibliotekę Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA1bYrHo1KF68x0UIXJnDqFtKmlNSGjZE&libraries=places&callback=initAutocomplete" async defer></script>
    <script>
        function initAutocomplete() {
            const addressInput = document.getElementById('address');
            const streetInput = document.getElementById('ulica');
            const streetNumberInput = document.getElementById('numer_domu');
            const apartmentNumberInput = document.getElementById('numer_mieszkania');
            const postalCodeInput = document.getElementById('kod_pocztowy');
            const cityInput = document.getElementById('miasto');
            const countryInput = document.getElementById('kraj');

            const autocomplete = new google.maps.places.Autocomplete(addressInput, {
                componentRestrictions: { country: 'pl' }, // Ogranicz do Polski
                fields: ['address_component', 'geometry', 'name']
            });

            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();

                for (const component of place.address_components) {
                    const componentType = component.types[0];

                    switch (componentType) {
                        case 'street_number':
                            streetNumberInput.value = component.long_name;
                            break;
                        case 'route':
                            streetInput.value = component.long_name;
                            break;
                        case 'postal_code':
                            postalCodeInput.value = component.long_name;
                            break;
                        case 'locality':
                            cityInput.value = component.long_name;
                            break;
                        case 'administrative_area_level_1':
                            // województwo (opcjonalne)
                            break;
                        case 'country':
                            countryInput.value = component.long_name;
                            break;
                    }
                }
            });
        }
    </script>
</head>
<body>
<div class="navbar_container">
            <label for="sidebar-active" class="close-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="undefined"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>  
            <a href="index.php" class="home-link" id="home-page"><img src="photos/logo.svg" alt="LOGO"  id="logo" height="80"></a>
            <a href="#about" class="about-link" id="about-page">About us</a>
            <a href="#assortment" class="ulsugi-link" id="assortment">Our assortment</a>
            <a href="#contact" class="contact-link" id="contact-page">Contact</a>
            <a href="koszyk.php" class="button" id="cart-page"><img src="photos/cart.svg" alt="cart" class="cart" height="60px"></a>
    </div>
<h2>Dane Klienta</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Imię: <input type="text" name="imie"><br>
    Nazwisko: <input type="text" name="nazwisko"><br>
    Email: <input type="email" name="email"><br>
    Telefon: <input type="text" name="telefon"><br>

    <h2>Adres Dostawy</h2>
    <!-- Pole do autouzupełniania adresu -->
    Adres: <input type="text" id="address" placeholder="Wpisz adres"><br>

    <!-- Ukryte pola, które zostaną wypełnione przez API -->
    Ulica: <input type="text" name="ulica" id="ulica"><br>
    Numer domu: <input type="text" name="numer_domu" id="numer_domu"><br>
    Numer mieszkania: <input type="text" name="numer_mieszkania" id="numer_mieszkania"><br>
    Kod pocztowy: <input type="text" name="kod_pocztowy" id="kod_pocztowy"><br>
    Miasto: <input type="text" name="miasto" id="miasto"><br>
    Kraj: <input type="text" name="kraj" id="kraj" value="Polska"><br>

    <h2>Metoda Płatności</h2>
    <select name="metoda_platnosci">
        <?php
        while ($metoda = $metody_platnosci_result->fetch_assoc()) {
            echo "<option value='" . $metoda['metoda_id'] . "'>" . $metoda['nazwa'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Złóż Zamówienie">
</form>

</body>
</html>

<?php
$mysqli->close();
