<?php
include 'db_connect.php';
session_start();


$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Missing ID";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM assignments WHERE id = ?");
$stmt->execute([$id]);

header("Location: homework.php");
exit;
?>
