-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 09:11 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dyski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`) VALUES
(1, 'ADMIN', 'PASSWORD');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `adres_id` int(11) NOT NULL,
  `ulica` varchar(100) NOT NULL,
  `numer_domu` varchar(10) NOT NULL,
  `numer_mieszkania` varchar(10) DEFAULT NULL,
  `kod_pocztowy` varchar(10) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `kraj` varchar(50) NOT NULL DEFAULT 'Polska'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresy`
--

INSERT INTO `adresy` (`adres_id`, `ulica`, `numer_domu`, `numer_mieszkania`, `kod_pocztowy`, `miasto`, `kraj`) VALUES
(1, 'Niedźwiedzicka', '', NULL, '', 'Miłkowice', 'Polska'),
(2, 'Wrocławska', '', NULL, '40-217', 'Katowice', 'Polska'),
(3, 'Legnicka', '123', NULL, '54-206', 'Wrocław', 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `klient_id` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `data_rejestracji` date NOT NULL,
  `adres_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metodyplatnosci`
--

CREATE TABLE `metodyplatnosci` (
  `metoda_id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metodyplatnosci`
--

INSERT INTO `metodyplatnosci` (`metoda_id`, `nazwa`, `opis`) VALUES
(1, 'Karta kredytowa', 'Płatność za pomocą karty kredytowej (Visa, Mastercard, American Express)'),
(2, 'PayPal', 'Płatność za pomocą systemu PayPal'),
(3, 'Przelew bankowy', 'Standardowy przelew bankowy na konto sklepu'),
(4, 'Płatność przy odbiorze', 'Płatność gotówką lub kartą przy odbiorze zamówienia'),
(5, 'Szybki przelew (PayU, Przelewy24)', 'Płatność za pomocą systemów szybkich przelewów'),
(6, 'BLIK', 'Płatność za pomocą kodu BLIK'),
(7, 'Google Pay', 'Płatność za pomocą Google Pay'),
(8, 'Apple Pay', 'Płatność za pomocą Apple Pay');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parametrytechniczne`
--

CREATE TABLE `parametrytechniczne` (
  `parametr_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `interfejs` varchar(50) DEFAULT NULL,
  `predkosc_odczytu` int(11) DEFAULT NULL,
  `predkosc_zapisu` int(11) DEFAULT NULL,
  `czas_dostepu` varchar(20) DEFAULT NULL,
  `mtbf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pojemnosci`
--

CREATE TABLE `pojemnosci` (
  `pojemnosc_id` int(11) NOT NULL,
  `wartość` int(11) NOT NULL,
  `jednostka` varchar(2) DEFAULT 'GB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pojemnosci`
--

INSERT INTO `pojemnosci` (`pojemnosc_id`, `wartość`, `jednostka`) VALUES
(1, 128, 'GB'),
(2, 256, 'GB'),
(3, 512, 'GB'),
(4, 1024, 'GB'),
(5, 2048, 'GB'),
(6, 4096, 'GB'),
(7, 8192, 'GB');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycjezamowienia`
--

CREATE TABLE `pozycjezamowienia` (
  `pozycja_id` int(11) NOT NULL,
  `zamowienie_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena_jednostkowa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producenci`
--

CREATE TABLE `producenci` (
  `producent_id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `kraj` varchar(50) DEFAULT NULL,
  `rok_zalozenia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producenci`
--

INSERT INTO `producenci` (`producent_id`, `nazwa`, `kraj`, `rok_zalozenia`) VALUES
(1, 'Seagate', 'USA', 1979),
(2, 'Western Digital', 'USA', 1970),
(3, 'Samsung', 'Korea Południowa', 1938),
(4, 'Toshiba', 'Japonia', 1875),
(5, 'Kingston', 'USA', 1987);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `produkt_id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `typ_id` int(11) NOT NULL,
  `pojemnosc_id` int(11) NOT NULL,
  `producent_id` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `ilosc_w_magazynie` int(11) NOT NULL DEFAULT 0,
  `data_dodania` date NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`produkt_id`, `nazwa`, `typ_id`, `pojemnosc_id`, `producent_id`, `cena`, `ilosc_w_magazynie`, `data_dodania`, `opis`) VALUES
(12, '870 EVO SSD', 2, 3, 3, 349.99, 30, '2023-02-20', NULL),
(13, 'WD Blue HDD', 1, 5, 2, 399.99, 40, '2023-03-10', NULL),
(14, '980 Pro NVMe', 3, 5, 3, 599.99, 25, '2023-04-05', NULL),
(15, 'A400 SSD', 2, 2, 5, 199.99, 60, '2023-01-30', NULL),
(16, 'moj dysk', 5, 5, 3, 399.99, 59, '2025-04-02', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `promocje`
--

CREATE TABLE `promocje` (
  `promocja_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `data_rozpoczecia` date NOT NULL,
  `data_zakonczenia` date NOT NULL,
  `znizka_procent` int(11) DEFAULT NULL,
  `znizka_kwotowa` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statusyzamowienia`
--

CREATE TABLE `statusyzamowienia` (
  `status_id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL,
  `kolor` varchar(20) DEFAULT '#6c757d'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statusyzamowienia`
--

INSERT INTO `statusyzamowienia` (`status_id`, `nazwa`, `opis`, `kolor`) VALUES
(1, 'Nowe', 'Zamówienie zostało złożone, oczekuje na potwierdzenie', '#0d6efd'),
(2, 'Potwierdzone', 'Zamówienie zostało potwierdzone przez sklep', '#0dcaf0'),
(3, 'W przygotowaniu', 'Zamówienie jest kompletowane w magazynie', '#ffc107'),
(4, 'Gotowe do wysyłki', 'Zamówienie spakowane i gotowe do przekazania przewoźnikowi', '#fd7e14'),
(5, 'Wysłane', 'Zamówienie zostało przekazane do wysyłki', '#198754'),
(6, 'W drodze', 'Zamówienie jest w trakcie dostawy', '#20c997'),
(7, 'Dostarczone', 'Zamówienie zostało dostarczone do klienta', '#212529'),
(8, 'Anulowane', 'Zamówienie zostało anulowane przed wysyłką', '#6c757d'),
(9, 'Zwrócone', 'Zamówienie zostało zwrócone przez klienta', '#6c757d'),
(10, 'Problem', 'Wystąpił problem z zamówieniem wymagający interwencji', '#dc3545');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typydyskow`
--

CREATE TABLE `typydyskow` (
  `typ_id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typydyskow`
--

INSERT INTO `typydyskow` (`typ_id`, `nazwa`, `opis`) VALUES
(1, 'HDD', 'Tradycyjny dysk talerzowy'),
(2, 'SSD', 'Dysk półprzewodnikowy'),
(3, 'SSD NVMe', 'SSD z interfejsem NVMe'),
(4, 'SSD SATA', 'SSD z interfejsem SATA'),
(5, 'SSD M.2', 'SSD w formacie M.2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `zamowienie_id` int(11) NOT NULL,
  `klient_id` int(11) NOT NULL,
  `data_zamowienia` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `metoda_platnosci_id` int(11) NOT NULL,
  `cena_calkowita` decimal(10,2) NOT NULL,
  `adres_dostawy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`zamowienie_id`, `klient_id`, `data_zamowienia`, `status_id`, `metoda_platnosci_id`, `cena_calkowita`, `adres_dostawy_id`) VALUES
(1, 5, '2025-04-02 19:18:02', 5, 1, 200.00, 1),
(2, 5, '2025-04-02 19:24:15', 1, 7, 544.00, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`adres_id`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`klient_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `adres_id` (`adres_id`);

--
-- Indeksy dla tabeli `metodyplatnosci`
--
ALTER TABLE `metodyplatnosci`
  ADD PRIMARY KEY (`metoda_id`);

--
-- Indeksy dla tabeli `parametrytechniczne`
--
ALTER TABLE `parametrytechniczne`
  ADD PRIMARY KEY (`parametr_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- Indeksy dla tabeli `pojemnosci`
--
ALTER TABLE `pojemnosci`
  ADD PRIMARY KEY (`pojemnosc_id`);

--
-- Indeksy dla tabeli `pozycjezamowienia`
--
ALTER TABLE `pozycjezamowienia`
  ADD PRIMARY KEY (`pozycja_id`),
  ADD KEY `zamowienie_id` (`zamowienie_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- Indeksy dla tabeli `producenci`
--
ALTER TABLE `producenci`
  ADD PRIMARY KEY (`producent_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`produkt_id`),
  ADD KEY `typ_id` (`typ_id`),
  ADD KEY `pojemnosc_id` (`pojemnosc_id`),
  ADD KEY `producent_id` (`producent_id`);

--
-- Indeksy dla tabeli `promocje`
--
ALTER TABLE `promocje`
  ADD PRIMARY KEY (`promocja_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- Indeksy dla tabeli `statusyzamowienia`
--
ALTER TABLE `statusyzamowienia`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeksy dla tabeli `typydyskow`
--
ALTER TABLE `typydyskow`
  ADD PRIMARY KEY (`typ_id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`zamowienie_id`),
  ADD KEY `klient_id` (`klient_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `metoda_platnosci_id` (`metoda_platnosci_id`),
  ADD KEY `adres_dostawy_id` (`adres_dostawy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `adres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `klient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `metodyplatnosci`
--
ALTER TABLE `metodyplatnosci`
  MODIFY `metoda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parametrytechniczne`
--
ALTER TABLE `parametrytechniczne`
  MODIFY `parametr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pojemnosci`
--
ALTER TABLE `pojemnosci`
  MODIFY `pojemnosc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pozycjezamowienia`
--
ALTER TABLE `pozycjezamowienia`
  MODIFY `pozycja_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producenci`
--
ALTER TABLE `producenci`
  MODIFY `producent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `produkt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `promocje`
--
ALTER TABLE `promocje`
  MODIFY `promocja_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statusyzamowienia`
--
ALTER TABLE `statusyzamowienia`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `typydyskow`
--
ALTER TABLE `typydyskow`
  MODIFY `typ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `zamowienie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `klienci_ibfk_1` FOREIGN KEY (`adres_id`) REFERENCES `adresy` (`adres_id`);

--
-- Constraints for table `parametrytechniczne`
--
ALTER TABLE `parametrytechniczne`
  ADD CONSTRAINT `parametrytechniczne_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`produkt_id`);

--
-- Constraints for table `pozycjezamowienia`
--
ALTER TABLE `pozycjezamowienia`
  ADD CONSTRAINT `pozycjezamowienia_ibfk_1` FOREIGN KEY (`zamowienie_id`) REFERENCES `zamowienia` (`zamowienie_id`),
  ADD CONSTRAINT `pozycjezamowienia_ibfk_2` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`produkt_id`);

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`typ_id`) REFERENCES `typydyskow` (`typ_id`),
  ADD CONSTRAINT `produkty_ibfk_2` FOREIGN KEY (`pojemnosc_id`) REFERENCES `pojemnosci` (`pojemnosc_id`),
  ADD CONSTRAINT `produkty_ibfk_3` FOREIGN KEY (`producent_id`) REFERENCES `producenci` (`producent_id`);

--
-- Constraints for table `promocje`
--
ALTER TABLE `promocje`
  ADD CONSTRAINT `promocje_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`produkt_id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`klient_id`) REFERENCES `klienci` (`klient_id`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statusyzamowienia` (`status_id`),
  ADD CONSTRAINT `zamowienia_ibfk_3` FOREIGN KEY (`metoda_platnosci_id`) REFERENCES `metodyplatnosci` (`metoda_id`),
  ADD CONSTRAINT `zamowienia_ibfk_4` FOREIGN KEY (`adres_dostawy_id`) REFERENCES `adresy` (`adres_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
