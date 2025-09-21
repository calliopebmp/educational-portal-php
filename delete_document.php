<?php
include 'db_connect.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Document ID is missing.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT filename FROM documents WHERE id = ?");
$stmt->execute([$id]);
$document = $stmt->fetch();

$filepath = 'uploads/' . $document['filename'];
if (file_exists($filepath)) {
    unlink($filepath); // Delete file
}

$stmt = $pdo->prepare("DELETE FROM documents WHERE id = ?");
$stmt->execute([$id]);

header("Location: documents.php");
exit;
?>
