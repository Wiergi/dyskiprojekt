<?php
session_start();

// Połączenie z bazą danych
$mysqli = new mysqli("localhost", "root", "", "dyski");

if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk zakupowy</title>
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h2 {
            color: #00ccff;
            text-align: center;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        
        th {
            background-color: #0066cc;
            color: white;
            font-weight: bold;
        }
        
        tr:hover {
            background-color: #2a2a2a;
        }
        
        input[type="number"] {
            width: 60px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #444;
            background-color: #333;
            color: white;
        }
        
        button {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        
        .total-price {
            font-size: 1.2em;
            text-align: right;
            margin: 20px 0;
            color: #00ccff;
        }
        
        .checkout-btn {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .checkout-btn:hover {
            background-color: #218838;
        }
        
        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            color: #aaa;
            padding: 50px 0;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
/* header-style.css */

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
    <div class="container">
        <h2>Twój koszyk</h2>
        
        <?php if (isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Ilość</th>
                        <th>Cena jednostkowa</th>
                        <th>Cena</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cena_calkowita = 0;
                    
                    foreach ($_SESSION['koszyk'] as $produkt_id => $ilosc) {
                        $stmt = $mysqli->prepare("SELECT nazwa, cena FROM produkty WHERE produkt_id = ?");
                        $stmt->bind_param("i", $produkt_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result && $result->num_rows > 0) {
                            $produkt = $result->fetch_assoc();
                            
                            if (is_array($produkt)) {
                                $cena_jednostkowa = $produkt['cena'];
                                $cena = $cena_jednostkowa * $ilosc;
                                $cena_calkowita += $cena;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($produkt['nazwa']); ?></td>
                                    <td>
                                        <form method='post' action='aktualizuj_koszyk.php'>
                                            <input type='hidden' name='produkt_id' value='<?php echo $produkt_id; ?>'>
                                            <input type='number' name='ilosc' value='<?php echo $ilosc; ?>' min='1'>
                                            <button type='submit'>Aktualizuj</button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($cena_jednostkowa, 2); ?> PLN</td>
                                    <td><?php echo number_format($cena, 2); ?> PLN</td>
                                    <td class="actions">
                                        <form method='post' action='usun_z_koszyka.php'>
                                            <input type='hidden' name='produkt_id' value='<?php echo $produkt_id; ?>'>
                                            <button type='submit'>Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            
            <div class="total-price">
                <strong>Cena całkowita: <?php echo number_format($cena_calkowita, 2); ?> PLN</strong>
            </div>
            
            <div style="text-align: right;">
                <a href='zamowienie.php' class="checkout-btn">Przejdź do zamówienia</a>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <p>Twój koszyk jest pusty.</p>
                <a href="index.php" style="color: #00ccff; text-decoration: none;">← Wróć do sklepu</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$mysqli->close();
?>