-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2023 at 04:52 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21497835_fsd_whisky`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artistId` int(255) NOT NULL,
  `artistName` varchar(50) NOT NULL,
  `imageLink` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistId`, `artistName`, `imageLink`) VALUES
(1, 'Shania Twain', 'images/artistPhotos/stwain.jpg'),
(2, 'Taylor Swift', 'images/artistPhotos/tswift.png'),
(3, 'Charlotte Cardin', 'images/artistPhotos/ccardin.jpg'),
(4, 'Iron Maiden', 'images/artistPhotos/ironmaiden.png'),
(5, 'Jeremy Nettles', 'images/artistPhotos/whitedude.jpg'),
(6, 'Reignwolf', 'images/artistPhotos/reignwolf.png'),
(7, 'Dan Mangan', 'images/artistPhotos/dmangan.png'),
(8, 'The Glorious Sons', 'images/artistPhotos/glorioussons.png'),
(9, 'Garth Brooks', 'images/artistPhotos/gbrooks.png'),
(10, 'Carrie underwood', 'images/artistPhotos/cunderwood.png'),
(11, 'Willie Nelson', 'images/artistPhotos/wnelson.png'),
(12, 'Katy Perry', 'images/artistPhotos/kperry.png');

-- --------------------------------------------------------

--
-- Table structure for table `contactMessage`
--

CREATE TABLE `contactMessage` (
  `messageId` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(255) NOT NULL,
  `mainArtistId` int(255) NOT NULL,
  `location_Id` int(255) NOT NULL,
  `musicalGenre` int(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `openerArtistId` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `numOfTicketsSold` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `mainArtistId`, `location_Id`, `musicalGenre`, `date`, `time`, `openerArtistId`, `price`, `numOfTicketsSold`) VALUES
(1, 2, 1, 3, '2023-11-24', '19:00:00', 9, 150, 678),
(2, 6, 3, 1, '2023-11-15', '13:00:00', 12, 150, 280),
(3, 3, 1, 1, '2023-11-30', '15:00:00', 2, 175, 15),
(4, 1, 4, 5, '2023-11-21', '14:00:00', 12, 125, 129),
(5, 4, 4, 1, '2023-11-21', '21:00:00', 8, 75, 120),
(6, 7, 2, 3, '2023-11-30', '20:00:00', 2, 65, 53),
(7, 8, 3, 1, '2023-11-24', '18:00:00', 10, 35, 67),
(8, 10, 3, 5, '2023-12-11', '17:00:00', 1, 50, 100),
(9, 9, 1, 5, '2023-12-14', '17:30:00', 2, 50, 75),
(10, 11, 4, 5, '2023-12-05', '21:45:00', 9, 75, 20),
(11, 5, 2, 3, '2023-12-02', '18:30:00', 7, 70, 95),
(12, 12, 2, 3, '2023-11-20', '19:00:00', 7, 125, 123);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genreId` int(255) NOT NULL,
  `genreName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genreId`, `genreName`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Indie'),
(4, 'Metal'),
(5, 'Country');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationId` int(255) NOT NULL,
  `locationName` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `maxCapacity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationId`, `locationName`, `address`, `maxCapacity`) VALUES
(1, 'Place Bell', '1950 Rue Claude-Gagné', 500),
(2, 'MTELUS', '59 St Catherine St E', 600),
(3, 'Salle Wilfrid-Pelletier', '175 Saint-Catherine St W', 700),
(4, 'Place Des Arts', '1600 Saint-Urbain Street', 800);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `eventId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `ticketQuantity` int(11) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `eventId`, `userId`, `ticketQuantity`, `totalAmount`, `orderDate`) VALUES
(1, 2, 6, 1, 150.00, '2023-11-05 16:18:57'),
(2, 2, 6, 3, 450.00, '2023-11-05 16:19:14'),
(3, 5, 6, 1, 75.00, '2023-11-06 14:36:23'),
(4, 12, 7, 1, 125.00, '2023-11-06 14:37:08'),
(5, 2, 6, 2, 300.00, '2023-11-06 14:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketId` int(255) NOT NULL,
  `event_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketId`, `event_Id`) VALUES
(3, 1),
(2, 2),
(5, 2),
(7, 2),
(8, 2),
(4, 3),
(1, 4),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `accountStatus` tinyint(1) NOT NULL,
  `adminStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `password`, `firstName`, `lastName`, `email`, `phoneNumber`, `accountStatus`, `adminStatus`) VALUES
(6, '$2y$10$mlz9PRvxhTZufEaZvVrRC.6qQJzNxbFejQ/zFsR/EVsHwoAriK3sW', 'qwqw', 'qwqw', 'email@email.com', '111-111-1111', 1, 0),
(7, '$2y$10$lmMip2vtFmGTGqMvjGngN.Bk48NkVFDbEhLlI1ilsGur8WDEYCfLa', 'admin', 'account', 'admin@gmail.com', '123-456-7890', 1, 1),
(9, '$2y$10$RMFyVP3LSAqB7rl8npPX6uzKlAQjdSP7bkwSp1RVwWpAHMrArIiXi', 'Bo Kyung', 'Kim', 'bokyung@johnabbottcollege.net', '123-456-7890', 1, 0),
(11, '$2y$10$H/K75z6cR2zCJI/sfKum4up5U8boOD2Z0IpIfV3PXkqfIGWNHFega', 'not', 'admin', 'notadmin@gmail.com', '1234567890', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artistId`);

--
-- Indexes for table `contactMessage`
--
ALTER TABLE `contactMessage`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `mainArtistId` (`mainArtistId`),
  ADD KEY `locationId` (`location_Id`),
  ADD KEY `musicalGenre` (`musicalGenre`),
  ADD KEY `openerArtistId` (`openerArtistId`) USING BTREE;

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `eventId` (`eventId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `event_Id` (`event_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artistId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contactMessage`
--
ALTER TABLE `contactMessage`
  MODIFY `messageId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genreId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_artists` FOREIGN KEY (`mainArtistId`) REFERENCES `artist` (`artistId`),
  ADD CONSTRAINT `fk_events_artists_2` FOREIGN KEY (`openerArtistId`) REFERENCES `artist` (`artistId`),
  ADD CONSTRAINT `fk_events_genres` FOREIGN KEY (`musicalGenre`) REFERENCES `genres` (`genreId`),
  ADD CONSTRAINT `fk_events_locations` FOREIGN KEY (`location_Id`) REFERENCES `locations` (`locationId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `events` (`eventId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_events` FOREIGN KEY (`event_Id`) REFERENCES `events` (`eventId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
