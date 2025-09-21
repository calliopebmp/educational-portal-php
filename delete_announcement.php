<?php
include 'db_connect.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Announcement ID is missing.";
    exit;
}

$announcementId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->execute([$announcementId]);
    header("Location: announcement.php");
    exit;
} catch (PDOException $e) {
    echo "Error while deleting: " . $e->getMessage();
}
?>
