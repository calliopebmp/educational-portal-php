<?php
include 'db_connect.php';
session_start();


if (!isset($_GET['id'])) {
    echo "Missing document ID.";
    exit;
}



$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
$stmt->execute([$id]);
$document = $stmt->fetch();

if (!$document) {
    echo "Couldn't find the document.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!empty($title) && !empty($description)) {
        $stmt = $pdo->prepare("UPDATE documents SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $description, $id]);
        header("Location: documents.php");
        exit;
    } else {
        $error = "Συμπληρώστε όλα τα πεδία.";
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Edit Document</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; }
        input[type="text"], textarea {
            width: 100%; padding: 8px;
        }
        input[type="submit"] {
            margin-top: 20px; padding: 10px 15px;
            background: #0077cc; color: white; border: none; cursor: pointer;
        }
        input[type="submit"]:hover { background: #005fa3; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Edit Document</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($document['title']) ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($document['description']) ?></textarea>

        <input type="submit" value="Save">
    </form>

    <p><a href="documents.php">⟵ Back to documents</a></p>
</body>
</html>
