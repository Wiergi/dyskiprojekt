<?php
// Dane połączenia z bazą danych (zmień na swoje)
$host = "localhost";
$uzytkownik = "root";
$haslo = "";
$baza = "dyski";

// Połączenie z bazą danych
$mysqli = new mysqli($host, $uzytkownik, $haslo, $baza);

// Sprawdzenie połączenia
if ($mysqli->connect_error) {
    die("Błąd połączenia z bazą danych: " . $mysqli->connect_error);
}

// Zapytanie do pobrania wszystkich produktów
$zapytanie = "SELECT
                p.produkt_id,
                p.nazwa AS nazwa_produktu,
                p.cena,
                p.ilosc_w_magazynie,
                p.opis,
                pro.nazwa AS nazwa_producenta,
                t.nazwa AS nazwa_typu,
                poj.wartość AS wartosc_pojemnosci,
                poj.jednostka AS jednostka_pojemnosci
            FROM produkty p
            JOIN producenci pro ON p.producent_id = pro.producent_id
            JOIN typydyskow t ON p.typ_id = t.typ_id
            JOIN pojemnosci poj ON p.pojemnosc_id = poj.pojemnosc_id";
$wynik = $mysqli->query($zapytanie);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sklep z Dyskami</title>
    <link rel="stylesheet" type="text/css" href="stylep.css">
</head>
<body>
<div class="navbar_container">
            <label for="sidebar-active" class="close-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="undefined"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>  
            <a href="index.php" class="home-link" id="home-page"><img src="photos/logo.svg" alt="LOGO"  id="logo" height="80"></a>
            <a href="#about" class="about-link" id="about-page">About us</a>
            <a href="produkty.php" class="ulsugi-link" id="assortment">Our assortment</a>
            <a href="#contact" class="contact-link" id="contact-page">Contact</a>
            <a href="koszyk.php" class="button" id="cart-page"><img src="photos/cart.svg" alt="cart" class="cart" height="60px"></a>
    </div>
    <div class="container">
        <h1>Nasze Dyski</h1>

        <div class="products-grid">
            <?php
            // Wyświetlanie produktów
            if ($wynik->num_rows > 0) {
                while ($produkt = $wynik->fetch_assoc()) {
                    ?>
                    <div class="product-card">
                        <img src="https://via.placeholder.com/200x150" alt="<?php echo htmlspecialchars($produkt['nazwa_produktu']); ?>">
                        <div class="product-info">
                            <h2><?php echo htmlspecialchars($produkt['nazwa_produktu']); ?></h2>
                            <p class="product-type"><?php echo htmlspecialchars($produkt['nazwa_typu']); ?></p>
                            <p class="product-capacity"><?php echo htmlspecialchars($produkt['wartosc_pojemnosci'] . ' ' . $produkt['jednostka_pojemnosci']); ?></p>
                            <p class="product-manufacturer">Producent: <?php echo htmlspecialchars($produkt['nazwa_producenta']); ?></p>
                            <p class="product-price"><?php echo htmlspecialchars(number_format($produkt['cena'], 2)); ?> PLN</p>
                            <?php if ($produkt['ilosc_w_magazynie'] > 0): ?>
                                <p class="product-availability">Dostępność: <?php echo htmlspecialchars($produkt['ilosc_w_magazynie']); ?> szt.</p>
                            <?php else: ?>
                                <p class="product-availability product-unavailable">Niedostępny</p>
                            <?php endif; ?>

                            <a href="index1.php?produkt_id=<?php echo htmlspecialchars($produkt['produkt_id']); ?>" class="product-details">Zobacz szczegóły</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<p>Brak produktów w ofercie.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
// Zamknięcie połączenia
$mysqli->close();
?>
