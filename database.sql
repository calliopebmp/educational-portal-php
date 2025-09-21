-- Course Management System - Demo Database
-- Compatible with MySQL / MDB

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

