<?php
include 'config.php';

// Pobranie danych do dashboardu
$stmt_produkty_count = $pdo->query("SELECT COUNT(*) FROM produkty");
$produkty_count = $stmt_produkty_count->fetchColumn();

$stmt_zamowienia_count = $pdo->query("SELECT COUNT(*) FROM zamowienia");
$zamowienia_count = $stmt_zamowienia_count->fetchColumn();

$stmt_klienci_count = $pdo->query("SELECT COUNT(*) FROM klienci");
$klienci_count = $stmt_klienci_count->fetchColumn();

$stmt_przychody = $pdo->query("SELECT SUM(cena_calkowita) FROM zamowienia");
$przychody = number_format($stmt_przychody->fetchColumn() ?? 0, 2, ',', ' ');

// Produkty z małym stanem magazynowym
$stmt_male_stany = $pdo->query("
    SELECT 
        p.produkt_id, 
        p.nazwa, 
        t.nazwa AS typ_nazwa,
        pr.nazwa AS producent_nazwa, 
        po.wartość AS pojemnosc,
        po.jednostka AS pojemnosc_jednostka,
        p.ilosc_w_magazynie,
        p.cena
    FROM produkty p
    JOIN typydyskow t ON p.typ_id = t.typ_id
    JOIN producenci pr ON p.producent_id = pr.producent_id
    JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id
    WHERE p.ilosc_w_magazynie < 30
");
$produkty_male_stany = $stmt_male_stany->fetchAll();


// Ostatnie zamówienia
$stmt_ostatnie_zamowienia = $pdo->query("
    SELECT 
        z.zamowienie_id,
        z.data_zamowienia,
        k.imie,
        k.nazwisko,
        s.nazwa AS status_nazwa,
        s.kolor AS status_kolor,
        z.cena_calkowita,
        COUNT(pz.pozycja_id) AS liczba_produktow
    FROM zamowienia z
    JOIN klienci k ON z.klient_id = k.klient_id
    JOIN statusyzamowienia s ON z.status_id = s.status_id
    LEFT JOIN pozycjezamowienia pz ON z.zamowienie_id = pz.zamowienie_id
    GROUP BY z.zamowienie_id
    ORDER BY z.data_zamowienia DESC
    LIMIT 5
");
$ostatnie_zamowienia = $stmt_ostatnie_zamowienia->fetchAll();

// Ostatnio dodane produkty
$stmt_ostatnio_dodane = $pdo->query("
    SELECT 
        p.produkt_id, 
        p.nazwa, 
        t.nazwa AS typ_nazwa,
        pr.nazwa AS producent_nazwa,
        p.data_dodania,
        p.ilosc_w_magazynie,
        p.cena,
         po.wartość AS pojemnosc,
        po.jednostka AS pojemnosc_jednostka
    FROM produkty p
    JOIN typydyskow t ON p.typ_id = t.typ_id
    JOIN producenci pr ON p.producent_id = pr.producent_id
    JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id
    ORDER BY p.data_dodania DESC
    LIMIT 3
");
$ostatnio_dodane_produkty = $stmt_ostatnio_dodane->fetchAll();

// Lista produktów
$stmt_lista_produktow = $pdo->query("
    SELECT 
        p.produkt_id, 
        p.nazwa, 
        t.nazwa AS typ_nazwa,
        pr.nazwa AS producent_nazwa,
          po.wartość AS pojemnosc,
        po.jednostka AS pojemnosc_jednostka,
        p.ilosc_w_magazynie,
        p.cena,
        p.data_dodania
    FROM produkty p
    JOIN typydyskow t ON p.typ_id = t.typ_id
    JOIN producenci pr ON p.producent_id = pr.producent_id
    JOIN pojemnosci po ON p.pojemnosc_id = po.pojemnosc_id
");
$lista_produktow = $stmt_lista_produktow->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .sidebar {
            background-color: var(--secondary-color);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 250px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            margin-bottom: 0.25rem;
            border-radius: 0.25rem;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card .card-body {
            padding: 1.5rem;
        }
        
        .stat-card .card-title {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .card-value {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0;
        }
        
        .stat-card .card-icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
        }
        
        .section-title {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .table th {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .badge-type {
            padding: 0.4em 0.6em;
            font-size: 0.85em;
            font-weight: 500;
        }
        
        .progress {
            height: 20px;
            border-radius: 10px;
        }
        
        .progress-bar {
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin-right: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h3 class="text-center mb-4">
                <img src="../photos/logo.svg" width="150wv">
                <small class="d-block text-muted">Panel administracyjny</small>
            </h3>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produkty.php">
                        <i class="bi bi-hdd"></i> Produkty
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="zamowienia.php">
                        <i class="bi bi-cart"></i> Zamówienia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uzytkownicy.php">
                        <i class="bi bi-people"></i> Klienci
                    </a>
                </li>
            </ul>
            
            <div class="mt-auto pt-3 border-top">
                <div class="d-flex align-items-center">
                    <img src="../photos/ja.jpg" alt="Admin" class="rounded-circle me-2" width="40" height="40">
                    <div>
                        <div class="fw-bold">Administrator</div>
                        <small class="text-muted">admin@gmail.com</small>
                    </div>
                </div>
                <a href="#" class="btn btn-sm btn-outline-light w-100 mt-2">
                    <i class="bi bi-box-arrow-right"></i> Wyloguj
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <h2 class="mb-4"><i class="bi bi-speedometer2 me-2"></i> Dashboard</h2>
            
            <!-- Stat Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Produkty</h5>
                            <p class="card-value"><?= $produkty_count ?></p>
                            <i class="bi bi-hdd card-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Zamówienia</h5>
                            <p class="card-value"><?= $zamowienia_count ?></p>
                            <i class="bi bi-cart card-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Klienci</h5>
                            <p class="card-value"><?= $klienci_count ?></p>
                            <i class="bi bi-people card-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stat-card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">Przychód</h5>
                            <p class="card-value"><?= $przychody ?> zł</p>
                            <i class="bi bi-currency-dollar card-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nowa sekcja: Ostatnie zamówienia -->
            <div class="table-container">
                <h3 class="section-title">
                    <i class="bi bi-cart-check text-primary me-2"></i>
                    Ostatnie zamówienia
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Klient</th>
                                <th>Status</th>
                                <th>Wartość</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ostatnie_zamowienia as $zamowienie): ?>
                            <tr>
                                <td>#<?= $zamowienie['zamowienie_id'] ?></td>
                                <td><?= date('d.m.Y H:i', strtotime($zamowienie['data_zamowienia'])) ?></td>
                                <td><?= htmlspecialchars($zamowienie['imie'] . ' ' . htmlspecialchars($zamowienie['nazwisko'])) ?></td>
                                <td>
                                    <span class="badge" style="background-color: <?= $zamowienie['status_kolor'] ?>">
                                        <?= htmlspecialchars($zamowienie['status_nazwa']) ?>
                                    </span>
                                </td>
                                <td><?= number_format($zamowienie['cena_calkowita'], 2, ',', ' ') ?> zł</td>
                                <td>
                                    <a href="zamowienia.php?action=view&id=<?= $zamowienie['zamowienie_id'] ?>" class="btn btn-sm btn-outline-primary btn-action">
                                        <i class="bi bi-eye"></i> Podgląd
                                    </a>
                                    <a href="zamowienia.php?action=edit&id=<?= $zamowienie['zamowienie_id'] ?>" class="btn btn-sm btn-outline-warning btn-action">
                                        <i class="bi bi-pencil"></i> Edytuj
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-end mt-3">
                        <a href="zamowienia.php" class="btn btn-primary">
                            <i class="bi bi-list"></i> Zobacz wszystkie zamówienia
                        </a>
                    </div>
                </div>
            </div>
            <!-- Produkty z małym stanem -->
            <div class="table-container">
                <h3 class="section-title">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                    Produkty z małym stanem magazynowym
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa produktu</th>
                                <th>Typ</th>
                                <th>Producent</th>
                                <th>Pojemność</th>
                                <th>Stan</th>
                                <th>Cena</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produkty_male_stany as $produkt): ?>
                            <tr>
                                <td><?= $produkt['produkt_id'] ?></td>
                                <td><?= htmlspecialchars($produkt['nazwa']) ?></td>
                                <td>
                                    <span class="badge bg-secondary badge-type">
                                        <?= htmlspecialchars($produkt['typ_nazwa']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($produkt['producent_nazwa']) ?></td>
                                <td><?= $produkt['pojemnosc'] . ' ' . $produkt['pojemnosc_jednostka'] ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" 
                                             style="width: <?= min(100, $produkt['ilosc_w_magazynie']) ?>%" 
                                             aria-valuenow="<?= $produkt['ilosc_w_magazynie'] ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            <?= $produkt['ilosc_w_magazynie'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= number_format($produkt['cena'], 2, ',', ' ') ?> zł</td>
                                <td>
                                    <a href="produkty.php"><button class="btn btn-sm btn-primary btn-action">
                                        <i class="bi bi-plus-lg"></i> Uzupełnij
                                    </button></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Ostatnio dodane produkty -->
            <div class="table-container">
                <h3 class="section-title">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Ostatnio dodane produkty
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa produktu</th>
                                <th>Typ</th>
                                <th>Producent</th>
                                <th>Data dodania</th>
                                <th>Stan</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ostatnio_dodane_produkty as $produkt): ?>
                            <tr>
                                <td><?= $produkt['produkt_id'] ?></td>
                                <td><?= htmlspecialchars($produkt['nazwa']) ?></td>
                                <td>
                                    <span class="badge bg-primary badge-type">
                                        <?= htmlspecialchars($produkt['typ_nazwa']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($produkt['producent_nazwa']) ?></td>
                                <td><?= date('d.m.Y', strtotime($produkt['data_dodania'])) ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar <?= $produkt['ilosc_w_magazynie'] > 30 ? 'bg-success' : ($produkt['ilosc_w_magazynie'] > 10 ? 'bg-warning' : 'bg-danger') ?>" 
                                             role="progressbar" 
                                             style="width: <?= min(100, $produkt['ilosc_w_magazynie']) ?>%" 
                                             aria-valuenow="<?= $produkt['ilosc_w_magazynie'] ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            <?= $produkt['ilosc_w_magazynie'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= number_format($produkt['cena'], 2, ',', ' ') ?> zł</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Lista produktów -->
            <div class="table-container">
                <h3 class="section-title">
                    <i class="bi bi-list-ul text-success me-2"></i>
                    Lista produktów
                </h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nazwa produktu</th>
                                <th>Typ</th>
                                <th>Producent</th>
                                <th>Pojemność</th>
                                <th>Stan</th>
                                <th>Cena</th>
                                <th>Data dodania</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_produktow as $produkt): ?>
                            <tr>
                                <td><?= $produkt['produkt_id'] ?></td>
                                <td><?= htmlspecialchars($produkt['nazwa']) ?></td>
                                <td>
                                    <span class="badge <?= $produkt['typ_nazwa'] == 'HDD' ? 'bg-secondary' : 'bg-primary' ?> badge-type">
                                        <?= htmlspecialchars($produkt['typ_nazwa']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($produkt['producent_nazwa']) ?></td>
                                <td><?= $produkt['pojemnosc'] . ' ' . $produkt['pojemnosc_jednostka'] ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar <?= $produkt['ilosc_w_magazynie'] > 30 ? 'bg-success' : ($produkt['ilosc_w_magazynie'] > 10 ? 'bg-warning' : 'bg-danger') ?>" 
                                             role="progressbar" 
                                             style="width: <?= min(100, $produkt['ilosc_w_magazynie']) ?>%" 
                                             aria-valuenow="<?= $produkt['ilosc_w_magazynie'] ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                            <?= $produkt['ilosc_w_magazynie'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= number_format($produkt['cena'], 2, ',', ' ') ?> zł</td>
                                <td><?= date('d.m.Y', strtotime($produkt['data_dodania'])) ?></td>
                                <td>
                                   <a href="produkty.php"><button class="btn btn-sm btn-outline-primary btn-action">
                                        <i class="bi bi-pencil"></i>
                                    </button></a>
                                    <a href="produkty.php"><button class="btn btn-sm btn-outline-danger btn-action">
                                        <i class="bi bi-trash"></i>
                                    </button></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>