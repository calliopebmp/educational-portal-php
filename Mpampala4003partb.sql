-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 16, 2025 at 05:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student4003partb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `subject`, `body`, `date`) VALUES
(3, 'Έναρξη Μαθήματος', 'Το μάθημα ξεκινάει την Δευτέρα 10/08.', '2025-08-01'),
(4, 'Εργασία 1', 'Η πρώτη εργασία αναρτήθηκε και πρέπει να παραδοθεί μέχρι 20/08.', '2025-08-05'),
(5, 'Ενημέρωση', 'Η διάλεξη της Παρασκευής ακυρώνεται λόγω αργίας.', '2025-08-10'),
(10, 'Υποβλήθηκε η εργασία 14', 'Η ημερομηνία παράδοσης της εργασίας είναι 2026-02-10', '2026-02-10'),
(11, 'Υποβλήθηκε η εργασία 15', 'Η ημερομηνία παράδοσης της εργασίας είναι 1111-11-11', '2025-08-06'),
(12, 'Υποβλήθηκε η εργασία 16', 'Η ημερομηνία παράδοσης της εργασίας είναι 2026-03-25', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `deadline`) VALUES
(1, 'ergasia', 'sfasdfasd', '2026-03-03'),
(14, 'Καλησπέρα', 'Ναι, καλησπέρα', '2026-02-10'),
(15, 'fkasjdh', 'j', '1111-11-11'),
(16, 'kalhmera', 'kalhmera', '2026-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `filename`) VALUES
(2, 'bash', '111111', 'Καλλιόπη-Μπάμπαλα-CV (2).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `date_sent` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `loginame` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Tutor','Student') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `loginame`, `password`, `role`) VALUES
(6, 'Giorgos', 'Papadopoulos', 'tutor@csd.auth.test.gr', '1234', 'Tutor'),
(7, 'Maria', 'Nikolaou', 'student@csd.auth.test.gr', 'abcd', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
-- Course Management System - Demo Database
-- Compatible with MySQL / MariaDB

CREATE DATABASE IF NOT EXISTS course_portal;
USE course_portal;

-- -----------------------------
-- Table: Announcements
-- -----------------------------
CREATE TABLE announcements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  subject VARCHAR(255) NOT NULL,
  body TEXT NOT NULL,
  date DATE NOT NULL
);

INSERT INTO announcements (subject, body, date) VALUES
('Course Start', 'The course begins on Monday 10/08.', '2025-08-01'),
('Assignment 1', 'The first assignment is posted and must be submitted by 20/08.', '2025-08-05'),
('Update', 'Friday’s lecture is canceled due to holiday.', '2025-08-10');

-- -----------------------------
-- Table: Assignments
-- -----------------------------
CREATE TABLE assignments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  deadline DATE NOT NULL
);

INSERT INTO assignments (title, description, deadline) VALUES
('Assignment 1', 'Build a simple static website using HTML/CSS.', '2025-09-30'),
('Assignment 2', 'Develop a PHP script with CRUD functionality.', '2025-10-15');

-- -----------------------------
-- Table: Documents
-- -----------------------------
CREATE TABLE documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  filename VARCHAR(255) NOT NULL
);

-- Example demo document entry
INSERT INTO documents (title, description, filename) VALUES
('Course Syllabus', 'Syllabus for the course in PDF format.', 'syllabus.pdf');

-- -----------------------------
-- Table: Messages (from contact form)
-- -----------------------------
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  from_email VARCHAR(100) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  body TEXT NOT NULL,
  date_sent DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------
-- Table: Users
-- -----------------------------
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  loginame VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('Tutor','Student') NOT NULL
);

-- Demo accounts (⚠ plain text passwords for demo only)
INSERT INTO users (firstname, lastname, loginame, password, role) VALUES
('John', 'Doe', 'tutor@test.com', '1234', 'Tutor'),
('Jane', 'Smith', 'student@test.com', 'abcd', 'Student');

