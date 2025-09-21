<?php
include 'db_connect.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($title) || empty($description) || empty($_FILES['file']['name'])) {
        $errors[] = "Please fill in all fields and select a file.";
    } else {
        $uploadDir = 'uploads/';
        $filename = basename($_FILES['file']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $stmt = $pdo->prepare("INSERT INTO documents (title, description, filename) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $filename]);
            header("Location: documents.php");
            exit;
        } else {
            $errors[] = "File upload failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Document</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; }
        input[type="text"], textarea {
            width: 100%; padding: 8px;
        }
        input[type="file"] { margin-top: 10px; }
        input[type="submit"] {
            margin-top: 20px; padding: 10px 15px;
            background: #0077cc; color: white; border: none; cursor: pointer;
        }
        input[type="submit"]:hover { background: #005fa3; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Upload New Document</h1>

    <?php if ($errors): ?>
        <div class="error">
            <?php foreach ($errors as $e): ?>
                <p><?= htmlspecialchars($e) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <label for="file">Select File:</label>
        <input type="file" name="file" id="file" required>

        <input type="submit" value="Upload">
    </form>

    <p><a href="documents.php">⟵ Back to Documents</a></p>
</body>
</html>
