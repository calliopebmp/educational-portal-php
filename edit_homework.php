<?php
include 'db_connect.php';
session_start();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Missing ID";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM assignments WHERE id = ?");
$stmt->execute([$id]);
$homework = $stmt->fetch();

if (!$homework) {
    echo "Assignment not found";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';

    if (!empty($title) && !empty($description) && !empty($deadline)) {
        $stmt = $pdo->prepare("UPDATE assignments SET title = ?, description = ?, deadline = ? WHERE id = ?");
        $stmt->execute([$title, $description, $deadline, $id]);
        header("Location: homework.php");
        exit;
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Assignment</title>
</head>
<body>
  <h1>Edit Assignment</h1>

  <?php if (isset($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($homework['title']) ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="5" cols="50" required><?= htmlspecialchars($homework['description']) ?></textarea><br><br>

    <label>Deadline:</label><br>
    <input type="date" name="deadline" value="<?= htmlspecialchars($homework['deadline']) ?>" required><br><br>

    <input type="submit" value="Save">
  </form>

  <p><a href="homework.php">⟵ Back</a></p>
</body>
</html>
