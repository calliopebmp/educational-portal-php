<?php
include 'db_connect.php';
session_start();

// If the user is not logged in, redirect to login.html
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Page - Educational Website</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      border: 1px solid black;
      margin: 20px;
    }

    .header {
      text-align: center;
      font-weight: bold;
      padding: 10px;
      border-bottom: 1px solid black;
    }

    .main {
      display: flex;
    }

    .sidebar {
      width: 20%;
      background-color: #e0e0e0;
      border-right: 1px solid black;
    }

    .sidebar a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: black;
      border-bottom: 1px solid #ccc;
    }

    .sidebar a:hover {
      background-color: #ccc;
    }

    .content {
      width: 80%;
      padding: 20px;
    }

    ul {
      list-style: disc;
      padding-left: 20px;
    }

    #welcome-image {
      max-width: 100%;
      height: auto;
      margin-top: 20px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <div class="header">
    Home Page - Educational Website
  </div>

  <div class="main">
    <div class="sidebar">
      <a href="index.php">Home</a>
      <a href="announcement.php">Announcements</a>
      <a href="communication.php">Communication</a>
      <a href="documents.php">Course Documents</a>
      <a href="homework.php">Assignments</a>
    </div>

    <div class="content">
      <p>Welcome to the educational website for learning HTML!</p>
      <p>This website has been designed to support an undergraduate course and includes the following sections:</p>
      <ul>
        <li><strong>Announcements:</strong> Important updates and course-related news.</li>
        <li><strong>Communication:</strong> Contact the instructor via email or web form.</li>
        <li><strong>Course Documents:</strong> Downloadable files related to the course.</li>
        <li><strong>Assignments:</strong> Instructions and information about course assignments.</li>
      </ul>
      <img src="welcome.jpg" alt="Welcome" id="welcome-image">
    </div>
  </div>
</div>

</body>
</html>
