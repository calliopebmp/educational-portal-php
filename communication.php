<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Communication</title>
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

  </style>
</head>

<body>
<div class="wrapper">
  <div class="header">
    Επικοινωνία
  </div>

  <div class="main">
    <div class="sidebar">
      <a href="index.php">Home</a>
      <a href="announcement.php">Announcements</a>
      <a href="communication.php">Communication</a>
      <a href="documents.php">Documents</a>
      <a href="homework.php">Assignments</a>
    </div>

   <div class="content">
  <p>This page provides two options for sending an email to the instructor:</p>
  <ul>
    <li>Via web form</li>
    <li>Using an email address</li>
  </ul>

  <h2>Send Email via Web Form</h2>
  <form>
    <label>From: <input type="email" name="from" required></label><br><br>
    <label>Subject: <input type="text" name="subject" required></label><br><br>
    <label>Message:<br>
      <textarea name="body" rows="6" cols="40" required></textarea></label><br><br>
    <input type="submit" value="Send">
  </form>

  <hr>

  <h2>Send Email Using Address</h2>
  <p>You can send an email directly to:
    <a href="https://www.microsoft.com/en-us/microsoft-365/outlook/email-and-calendar-software-microsoft-outlook?deeplink=%2fmail%2f0%2f%3fnlp%3d0&sdf=0">
      tutor@csd.auth.test.gr
    </a>
  </p>
</div>




  </div>

</div>

</body>
</html>
