<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: contacts.php");
    } else {
        echo "<p class='text-red-500 text-center'>Invalid credentials!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST">
            <input type="text" name="username" class="border border-gray-300 p-2 mb-4 w-full rounded" placeholder="Username" required>
            <input type="password" name="password" class="border border-gray-300 p-2 mb-4 w-full rounded" placeholder="Password" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600">Login</button>
        </form>
        <p class="mt-4 text-center">Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Register here</a>.</p>
    </div>
</body>
</html>
