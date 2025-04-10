<?php
include 'adminpanel/config.php';

if (!isset($mysqli)) {
    $mysqli = new mysqli("localhost", "root", "", "dyski");

    // Sprawdź połączenie
    if ($mysqli->connect_error) {
        die("Błąd połączenia z bazą danych: " . $mysqli->connect_error);
    }
}

// Pobranie szczegółów produktu na podstawie ID
$product_id = isset($_GET['produkt_id']) ? intval($_GET['produkt_id']) : 0;
$productQuery = "SELECT p.nazwa, p.cena, p.opis, p.ilosc_w_magazynie, p.data_dodania, 
                        po.wartość AS pojemnosc, pr.nazwa AS producent, t.opis AS typ_opis 
                 FROM produkty p 
                 JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id 
                 JOIN producenci pr ON p.producent_id = pr.producent_id 
                 JOIN typydyskow t ON p.typ_id = t.typ_id 
                 WHERE p.produkt_id = $product_id";
$productResult = $mysqli->query($productQuery);

if ($productResult && $productResult->num_rows > 0) {
    $product = $productResult->fetch_assoc();
} else {
    die("Produkt nie został znaleziony.");
}

// Pobranie dostępnych pojemności dla tego produktu
$capacitiesQuery = "SELECT po.wartość AS pojemnosc, p.ilosc_w_magazynie 
                    FROM produkty p 
                    JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id 
                    WHERE p.nazwa = '" . $mysqli->real_escape_string($product['nazwa']) . "'";
$capacitiesResult = $mysqli->query($capacitiesQuery);
$capacities = [];
while ($row = $capacitiesResult->fetch_assoc()) {
    $capacities[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nazwa']); ?> - Zakup</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }
        .product-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            gap: 40px;
        }
        .product-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #222;
            border-radius: 10px;
            padding: 20px;
        }
        .product-image img {
            max-width: 100%;
            border-radius: 10px;
        }
        .product-details {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .product-title {
            font-size: 2em;
            font-weight: bold;
        }
        .product-price {
            font-size: 1.5em;
            color: #00ccff;
        }
        .product-specs {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .product-specs li {
            font-size: 1em;
            color: #aaa;
        }
        .product-description {
            font-size: 1em;
            line-height: 1.5;
            color: #ddd;
        }
        .buy-section {
            margin-top: 20px;
        }
        .buy-button {
            padding: 15px 30px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .buy-button:hover {
            background-color: #0055aa;
        }
        .stock-info {
            font-size: 1em;
            color: <?php echo $product['ilosc_w_magazynie'] > 0 ? '#0f0' : '#f00'; ?>;
        }
        .capacity-select {
            margin-top: 10px;
        }
        .capacity-select select {
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #222;
            color: #fff;
        }
        .capacity-select select:disabled {
            background-color: #555;
            cursor: not-allowed;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #222;
            color: #fff;
        }
        
        .navbar_container {
  display: flex;
  justify-content: space-around; /* Równomierne rozmieszczenie elementów */
  align-items: center; /* Wyśrodkowanie w pionie */
  background-color: #333; /* Ciemne tło */
  color: white; /* Biały kolor tekstu */
  padding: 10px 20px; /* Odstępy wewnątrz */
  position: relative; /* Dla pozycjonowania absolutnego przycisku zamykania */
}

/* Ukryj checkbox i przycisk zamykania na większych ekranach */
.close-sidebar-button {
  display: none;
}

.home-link {
  text-decoration: none; /* Usuń podkreślenie */
  color: white;
  font-weight: bold;
  font-size: 1.2em;
}

#logo {
  height: 60px; /* Zmniejsz logo */
}

/* Style dla linków nawigacyjnych */
.navbar_container a {
  color: #eee; /* Jaśniejszy kolor linków */
  text-decoration: none;
  padding: 8px 15px;
  border-radius: 5px;
  transition: background-color 0.3s ease; /* Efekt hover */
}

.navbar_container a:hover {
  background-color: #555; /* Jaśniejsze tło po najechaniu */
}

/* Style dla ikony koszyka */
.cart {
  height: 40px; /* Zmniejsz ikonę koszyka */
  vertical-align: middle; /* Wyśrodkuj w pionie */
}

/* Style dla przycisku koszyka */
#cart-page {
  background-color: #4CAF50; /* Zielony kolor przycisku */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

#cart-page:hover {
  background-color: #367c39; /* Ciemniejszy zielony po najechaniu */
}

/* Media queries dla responsywności (dla małych ekranów) */
@media (max-width: 768px) {
  .navbar_container {
      flex-direction: column; /* Elementy w kolumnie */
      align-items: flex-start; /* Wyrównaj do lewej */
  }

  /* Pokaż checkbox i przycisk zamykania */
  .close-sidebar-button {
      display: block;
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border: none;
      cursor: pointer;
  }

  .close-sidebar-button svg {
      fill: white; /* Kolor ikony */
  }

  /* Ukryj elementy nawigacyjne */
  .navbar_container > a {
      display: none;
  }

  #cart-page {
      margin-top: 10px;
  }
}

    </style>
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
    <div class="product-page">
        <div class="product-image">
            <img src="photos/product-placeholder.png" alt="<?php echo htmlspecialchars($product['nazwa']); ?>">
        </div>
        <div class="product-details">
            <h1 class="product-title"><?php echo htmlspecialchars($product['nazwa']); ?></h1>
            <p class="product-price"><?php echo number_format($product['cena'], 2); ?> PLN</p>
            <ul class="product-specs">
                <li>Producent: <?php echo htmlspecialchars($product['producent']); ?></li>
                <li>Pojemność: <?php echo htmlspecialchars($product['pojemnosc']); ?> GB</li>
                <li>Data dodania: <?php echo htmlspecialchars($product['data_dodania']); ?></li>
                <li>Ilość w magazynie: <?php echo htmlspecialchars($product['ilosc_w_magazynie']); ?></li>
                <li>Opis typu: <?php echo htmlspecialchars($product['typ_opis']); ?></li>
            </ul>
            <p class="product-description"><?php echo nl2br(htmlspecialchars($product['opis'])); ?></p>
            <div class="capacity-select">
                <label for="capacity">Wybierz pojemność:</label>
                <select id="capacity">
                    <?php foreach ($capacities as $capacity): ?>
                        <option value="<?php echo htmlspecialchars($capacity['pojemnosc']); ?>" 
                                <?php echo $capacity['ilosc_w_magazynie'] <= 0 ? 'disabled' : ''; ?>>
                            <?php echo htmlspecialchars($capacity['pojemnosc']); ?> GB 
                            <?php echo $capacity['ilosc_w_magazynie'] <= 0 ? '(Niedostępne)' : ''; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="buy-section">
                <p class="stock-info">
                    <?php echo $product['ilosc_w_magazynie'] > 0 ? 'Produkt dostępny w magazynie' : 'Produkt niedostępny'; ?>
                </p>
                <?php if ($product['ilosc_w_magazynie'] > 0): ?>
                    <form method="post" action="dodaj_do_koszyka.php">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        Ilość: <input type="number" name="ilosc" value="1" min="1">
                        <button type="submit">Dodaj do koszyka</button>
                    </form>
                <?php else: ?>
                    <button class="buy-button" disabled>Brak w magazynie</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
        function buyProduct(productId) {
            const selectedCapacity = document.getElementById('capacity').value;
            alert("Produkt o ID " + productId + " z pojemnością " + selectedCapacity + " GB został dodany do koszyka!");
            // Możesz tutaj dodać logikę do wysyłania żądania do serwera
        }
    </script>
</body>
</html>
