-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Kwi 2018, 16:36
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aniziol`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin_message`
--

CREATE TABLE `admin_message` (
  `Id_msg` int(11) NOT NULL,
  `message` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `admin_message`
--

INSERT INTO `admin_message` (`Id_msg`, `message`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adress`
--

CREATE TABLE `adress` (
  `id_Adress` int(11) NOT NULL,
  `Country` varchar(45) DEFAULT NULL,
  `Street` varchar(45) DEFAULT NULL,
  `Flat_number` varchar(45) DEFAULT NULL,
  `Property_number` varchar(45) DEFAULT NULL,
  `Postcode` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `adress`
--

INSERT INTO `adress` (`id_Adress`, `Country`, `Street`, `Flat_number`, `Property_number`, `Postcode`) VALUES
(48, 'Krakow, Polska', 'Ul.dluga', '321', '322', '31-122'),
(49, 'Warszawa, Polska', 'Ul.Mala', '3', '21', '123-122');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `booking`
--

CREATE TABLE `booking` (
  `Id_Booking` int(11) NOT NULL,
  `Start_date` datetime NOT NULL,
  `End_date` datetime NOT NULL,
  `Date_made` datetime NOT NULL,
  `id_User_Details` int(11) NOT NULL,
  `id_Property` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `booking`
--

INSERT INTO `booking` (`Id_Booking`, `Start_date`, `End_date`, `Date_made`, `id_User_Details`, `id_Property`) VALUES
(60, '2018-01-18 00:00:00', '2018-01-19 00:00:00', '2018-01-17 00:00:00', 149, 52);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currency`
--

CREATE TABLE `currency` (
  `id_Currency` int(11) NOT NULL,
  `Value` varchar(45) DEFAULT NULL,
  `Value_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `currency`
--

INSERT INTO `currency` (`id_Currency`, `Value`, `Value_type`) VALUES
(41, '150', 'PLN'),
(42, '500', ' PLN');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `image`
--

CREATE TABLE `image` (
  `id_Image` int(11) NOT NULL,
  `File_name` varchar(1000) DEFAULT NULL,
  `id_Property` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `property`
--

CREATE TABLE `property` (
  `id_Property` int(11) NOT NULL,
  `Description` varchar(5000) DEFAULT NULL,
  `Bedroom_count` varchar(11) DEFAULT NULL,
  `id_Adress` int(11) NOT NULL,
  `id_Currency` int(11) NOT NULL,
  `id_User_Details` int(11) NOT NULL,
  `File_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `property`
--

INSERT INTO `property` (`id_Property`, `Description`, `Bedroom_count`, `id_Adress`, `id_Currency`, `id_User_Details`, `File_path`) VALUES
(52, 'Nice room', '2', 48, 41, 149, 'resources/uploads/abs.jpg'),
(53, 'Best room ever', '3', 49, 42, 149, 'resources/uploads/sadf.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id_Roles` int(11) NOT NULL,
  `Role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id_Roles`, `Role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_Users` int(11) NOT NULL,
  `Login` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Register_date` date DEFAULT NULL,
  `id_User_Details` int(11) NOT NULL,
  `Role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_Users`, `Login`, `Email`, `Password`, `Register_date`, `id_User_Details`, `Role`) VALUES
(146, 'admin', 'admin@admin.pl', 'admin', '2018-01-01', 146, 2),
(149, 'Aronh09', 'areknh@o2.pl', '123', '2018-01-01', 149, 1),
(151, 'Grazyna123', 'G@o2.pl', '123', '2018-01-01', 151, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_details`
--

CREATE TABLE `user_details` (
  `id_User_Details` int(11) NOT NULL,
  `First_name` varchar(45) DEFAULT NULL,
  `Second_name` varchar(45) DEFAULT NULL,
  `Gender` varchar(45) DEFAULT NULL,
  `Number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user_details`
--

INSERT INTO `user_details` (`id_User_Details`, `First_name`, `Second_name`, `Gender`, `Number`) VALUES
(146, 'admin', 'admin', 'male', 321421),
(149, 'Arek', 'Niziolek', 'male', 66742323),
(151, 'Grazynka', 'Polka', 'female', 124234);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin_message`
--
ALTER TABLE `admin_message`
  ADD PRIMARY KEY (`Id_msg`);

--
-- Indexes for table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`id_Adress`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Id_Booking`),
  ADD KEY `fk_Booking_User_Details1_idx` (`id_User_Details`),
  ADD KEY `fk_Booking_Property_idx` (`id_Property`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id_Currency`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_Image`),
  ADD KEY `fk_Image_Property1_idx` (`id_Property`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id_Property`),
  ADD KEY `fk_Property_Adress1_idx` (`id_Adress`),
  ADD KEY `fk_Property_Currency1_idx` (`id_Currency`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Roles`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_Users`),
  ADD UNIQUE KEY `id_Users_UNIQUE` (`id_Users`),
  ADD KEY `fk_Users_User_Details1_idx` (`id_User_Details`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id_User_Details`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin_message`
--
ALTER TABLE `admin_message`
  MODIFY `Id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `adress`
--
ALTER TABLE `adress`
  MODIFY `id_Adress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `booking`
--
ALTER TABLE `booking`
  MODIFY `Id_Booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT dla tabeli `currency`
--
ALTER TABLE `currency`
  MODIFY `id_Currency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `property`
--
ALTER TABLE `property`
  MODIFY `id_Property` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id_User_Details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_Booking_User_Details1` FOREIGN KEY (`id_User_Details`) REFERENCES `user_details` (`id_User_Details`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_Image_Property1` FOREIGN KEY (`id_Property`) REFERENCES `property` (`id_Property`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `fk_Property_Adress1` FOREIGN KEY (`id_Adress`) REFERENCES `adress` (`id_Adress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Property_Currency1` FOREIGN KEY (`id_Currency`) REFERENCES `currency` (`id_Currency`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_User_Details1` FOREIGN KEY (`id_User_Details`) REFERENCES `user_details` (`id_User_Details`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
