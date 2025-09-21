<?php
include 'db_connect.php';
session_start();

// Get form data
$loginame = $_POST['loginame'] ?? '';
$password = $_POST['password'] ?? '';

if (!$loginame || !$password) {
    die("Please fill in all fields.");
}

// Search for user by email AND password
$stmt = $pdo->prepare("SELECT * FROM users WHERE loginame = :loginame AND password = :password LIMIT 1");
$stmt->execute([
    'loginame' => $loginame,
    'password' => $password
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Successful login
    $_SESSION['id'] = $user['id'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['lastname'] = $user['lastname'];
    $_SESSION['role'] = $user['role'];

    header("Location: index.php");
    exit();
} else {
    echo "Invalid login credentials.";
}
?>