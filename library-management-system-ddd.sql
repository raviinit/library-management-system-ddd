-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for library-management-system-ddd
CREATE DATABASE IF NOT EXISTS `library-management-system-ddd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `library-management-system-ddd`;

-- Dumping structure for table library-management-system-ddd.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT '123456',
  `published_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Available','Borrowed','Not Available') DEFAULT 'Available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table library-management-system-ddd.books: ~7 rows (approximately)
INSERT INTO `books` (`id`, `title`, `author`, `genre`, `isbn`, `published_date`, `status`) VALUES
	(1, 'Book 1', 'Ravinder L', 'Games', '123456', '2024-08-02 22:46:40', 'Available'),
	(2, 'Book 2', 'Ravinder L', 'Music', '123456', '2024-08-02 22:46:40', 'Available'),
	(3, 'Book 3', 'Ravin 3u', 'Sports3', '123456', '2024-08-02 22:46:40', 'Borrowed'),
	(4, 'Book 4', 'Ravinder L', 'Chess', '123456', '2024-08-02 22:46:40', 'Borrowed'),
	(5, 'Book 5', 'Ravinder L', 'Movies', '123456', '2024-08-02 22:46:40', 'Available'),
	(6, 'Book 6', 'Ravin', 'Sports', '123456', '2024-08-05 14:29:09', 'Available'),
	(9, 'Book 8', 'Ravin 8', 'Sports', '123456', '2024-08-05 16:33:55', 'Available');

-- Dumping structure for table library-management-system-ddd.borrows
CREATE TABLE IF NOT EXISTS `borrows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `checkout_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkin_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table library-management-system-ddd.borrows: ~7 rows (approximately)
INSERT INTO `borrows` (`id`, `user_id`, `book_id`, `checkout_date`, `checkin_date`) VALUES
	(1, 1, 1, '2024-07-02 00:00:00', '2024-07-05 00:00:00'),
	(2, 2, 3, '2024-07-02 00:00:00', '2024-07-05 00:00:00'),
	(3, 2, 3, '2024-07-02 00:00:00', '2024-08-05 23:17:05'),
	(4, 4, 2, '2024-08-01 00:00:00', '2024-08-05 18:07:44'),
	(5, 5, 4, '2024-08-01 00:00:00', '2024-08-05 18:03:27'),
	(6, 1, 3, '2024-08-05 22:03:04', NULL),
	(8, 5, 2, '2024-08-05 23:43:10', '2024-08-05 18:13:58');

-- Dumping structure for table library-management-system-ddd.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('Admin','User','Super Admin') DEFAULT 'User',
  `registered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table library-management-system-ddd.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `registered_date`) VALUES
	(1, 'Ravinder L', 'raviinit@yahoo.com', '12345', 'Super Admin', '2024-08-02 22:47:55'),
	(2, 'Ravinder L', 'raviinit@ymail.com', '12345', 'Admin', '2024-08-02 22:47:55'),
	(3, 'Ravinder L', 'raviinit9@gmail.com', '12345', 'Admin', '2024-08-02 22:47:55'),
	(4, 'Ravinder L', 'abcd@gmail.com', '12345', 'User', '2024-08-02 22:47:55'),
	(5, 'Ravin 5up', 'ravin5@yahoo.com', '54321', 'Admin', '2024-08-02 22:47:55'),
	(7, 'Ravin test', 'ravin1@yahoo.com', '12345', 'Admin', '2024-08-05 18:26:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
