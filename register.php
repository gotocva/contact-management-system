<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        header("Location: login.php");
    } else {
        echo "<p class='text-red-500 text-center'>Registration failed!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Register</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form method="POST">
            <input type="text" name="username" class="border border-gray-300 p-2 mb-4 w-full rounded" placeholder="Username" required>
            <input type="password" name="password" class="border border-gray-300 p-2 mb-4 w-full rounded" placeholder="Password" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600">Register</button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a>.</p>
    </div>
</body>
</html>
