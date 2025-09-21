<?php
include 'db_connect.php';
session_start();




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';

    if (!empty($title) && !empty($description) && !empty($deadline)) {
        // Insert assignment
        $stmt = $pdo->prepare("INSERT INTO assignments (title, description, deadline) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $deadline]);

        $homeworkId = $pdo->lastInsertId();

        // Insert assignment
        $subject = "Assignment $homeworkId has been submitted";
        $content = "The deadline for this assignment is $deadline";
        $date = date('Y-m-d H:i:s');
        $stmt2 = $pdo->prepare("INSERT INTO announcements (subject, body, date) VALUES (?, ?, ?)");
        $stmt2->execute([$subject, $content, $date]);

        header("Location: homework.php");
        exit;
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Add Assignment</title>
</head>
<body>
  <h1>Add New Assignment</h1>

  <?php if (isset($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="5" cols="50" required></textarea><br><br>

    <label>Deadline:</label><br>
    <input type="date" name="deadline" required><br><br>

    <input type="submit" value="Save">
  </form>

  <p><a href="homework.php">⟵ Back</a></p>
</body>
</html>
