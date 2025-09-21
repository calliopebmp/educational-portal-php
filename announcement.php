<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;
}


// Έλεγχος για role και name
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;



// Ανάκτηση ανακοινώσεων
$stmt = $pdo->query("SELECT * FROM announcements ORDER BY date DESC");
$announcements = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Announcements</title>
  <style>
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    .wrapper { border: 1px solid black; margin: 20px; }
    .header { text-align: center; font-weight: bold; padding: 10px; border-bottom: 1px solid black; }
    .main { display: flex; }
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
    .sidebar a:hover { background-color: #ccc; }
    .content { width: 80%; padding: 20px; }
    hr { margin: 20px 0; }
    .tutor-controls a {
      margin-right: 10px;
      text-decoration: none;
      color: #0077cc;
    }
    .tutor-controls a:hover {
      text-decoration: underline;
    }
    .add-button {
      display: block;
      margin-bottom: 20px;
      text-align: right;
    }
    .add-button a {
      background: #0077cc;
      color: white;
      padding: 8px 12px;
      border-radius: 5px;
      text-decoration: none;
    }
    .add-button a:hover { background-color: #005fa3; }
  </style>
</head>

<body>
<div class="wrapper">
  <div class="header">
    Announcements
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
      <?php if ($role === 'Tutor'): ?>
        <div class="add-button">
          <a href="add_announcement.php">+ Add New Announcement</a>
        </div>
      <?php endif; ?>

      <?php foreach ($announcements as $a): ?>
        <h2>Announcement <?= $a['id'] ?></h2>
        <p><strong>Date:</strong> <?= htmlspecialchars($a['date']) ?></p>
        <p><strong>Subject:</strong> <?= htmlspecialchars($a['subject']) ?></p>
        <p>
          <?= nl2br(htmlspecialchars($a['body'])) ?>
          <?php if (stripos($a['body'], 'εργασία') !== false): ?>
            <br><a href="homework.php">Assignments</a>
          <?php endif; ?>
        </p>

        <?php if ($role === 'Tutor'): ?>
          <div class="tutor-controls">
            <a href="edit_announcement.php?id=<?= $a['id'] ?>">[edit]</a>
            <a href="delete_announcement.php?id=<?= $a['id'] ?>" onclick="return confirm('Διαγραφή;');">[delete]</a>
          </div>
        <?php endif; ?>

        <hr>
      <?php endforeach; ?>

      <p align="center"><a href="#top">&lt;top&gt;</a></p>
    </div>
  </div>
</div>
</body>
</html>