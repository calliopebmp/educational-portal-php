<?php
include 'db_connect.php';
session_start();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Missing announcement ID!";
    exit;
}

$error = '';
$subject = '';
$body = '';
$date = '';

// If the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = trim($_POST['subject'] ?? '');
    $body = trim($_POST['body'] ?? '');
    $date = $_POST['date'] ?? '';

    if (empty($subject) || empty($body) || empty($date)) {
        $error = "Missing value in the form!";
    } else {
        $stmt = $pdo->prepare("UPDATE announcements SET subject = ?, body = ?, date = ? WHERE id = ?");
        $stmt->execute([$subject, $body, $date, $id]);
        header("Location: announcement.php");
        exit;
    }
} else {
    // Load existing announcement
    $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = ?");
    $stmt->execute([$id]);
    $announcement = $stmt->fetch();

    if (!$announcement) {
        echo "Announcement not found!";
        exit;
    }

    $subject = $announcement['subject'];
    $body = $announcement['body'];
    $date = $announcement['date'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Announcement</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    form { max-width: 600px; margin: auto; }
    label { display: block; margin-top: 15px; }
    input[type="text"], input[type="date"], textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      box-sizing: border-box;
    }
    button {
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #0077cc;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background-color: #005fa3; }
    .error { color: red; font-weight: bold; margin-top: 10px; }
    a { display: block; margin-top: 20px; color: #0077cc; }
  </style>
</head>
<body>

<h1>Edit Announcement</h1>

<?php if ($error): ?>
  <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
  <label for="subject">Subject:</label>
  <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($subject) ?>" required>

  <label for="body">Content:</label>
  <textarea id="body" name="body" rows="6" required><?= htmlspecialchars($body) ?></textarea>

  <label for="date">Date:</label>
  <input type="date" id="date" name="date" value="<?= htmlspecialchars($date) ?>" required>

  <button type="submit">Save</button>
</form>

<a href="announcement.php">⟵ Back to Announcements</a>

</body>
</html>

