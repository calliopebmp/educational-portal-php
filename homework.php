<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;
}

$role = $_SESSION['role'] ?? null;

$stmt = $pdo->query("SELECT * FROM assignments ORDER BY id ASC");
$assignments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assignments</title>
  <style>
    body { font-family: Arial; margin: 0; padding: 0; }
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
    .tutor-controls a {
      margin-right: 10px;
      text-decoration: none;
      color: #0077cc;
    }
    .tutor-controls a:hover { text-decoration: underline; }
    .add-button {
      text-align: right;
      margin-bottom: 20px;
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
  <div class="header">Assignments: Course Documents</div>

  <div class="main">
    <div class="sidebar">
      <a href="index.php">Home</a>
      <a href="announcement.php">Announcements</a>
      <a href="communication.php">Communication</a>
      <a href="documents.php">Course Documents</a>
      <a href="homework.php">Assignments</a>
    </div>

    <div class="content">
      <?php if ($role === 'Tutor'): ?>
        <div class="add-button">
          <a href="add_homework.php">+ Add New Assignment</a>
        </div>
      <?php endif; ?>

      <?php foreach ($assignments as $h): ?>
        <h2>Assignment <?= $h['id'] ?>: <?= htmlspecialchars($h['title']) ?></h2>
        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($h['description'])) ?></p>
        <p><strong>Deadline:</strong> <?= htmlspecialchars($h['deadline']) ?></p>

        <?php if ($role === 'Tutor'): ?>
          <div class="tutor-controls">
            <a href="edit_homework.php?id=<?= $h['id'] ?>">[edit]</a>
            <a href="delete_homework.php?id=<?= $h['id'] ?>" onclick="return confirm('Delete this assignment?');">[delete]</a>
          </div>
        <?php endif; ?>

        <hr>
      <?php endforeach; ?>
    </div>
  </div>
</div>
</body>
</html>
