<?php
session_start();

// Hardcoded users for the application
$users = [
    'tom@mail.com' => ['name' => 'Tom', 'password' => 'password123'],
    'john@mail.com' => ['name' => 'John', 'password' => 'password456']
];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate login credentials
    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        // Login successful
        $_SESSION['user'] = $users[$email]['name'];
        header('Location: index.html');
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label
