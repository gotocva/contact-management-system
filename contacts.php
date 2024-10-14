<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add new contact
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO contacts (user_id, name, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $name, $email, $phone]);
}

// Edit contact
if (isset($_GET['edit'])) {
    $contact_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->execute([$contact_id, $_SESSION['user_id']]);
    $contact = $stmt->fetch();
}

// Update contact
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_contact'])) {
    $contact_id = $_POST['contact_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare("UPDATE contacts SET name = ?, email = ?, phone = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$name, $email, $phone, $contact_id, $_SESSION['user_id']]);
    header("Location: contacts.php");
}

// Delete contact
if (isset($_GET['delete'])) {
    $contact_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->execute([$contact_id, $_SESSION['user_id']]);
    header("Location: contacts.php");
}

// Fetch contacts
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$contacts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Contacts</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-2xl">Contact Management</h1>
        <a href="logout.php" class="text-white hover:underline">Logout</a>
    </header>
    <main class="flex-grow container mx-auto p-4">
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold mb-4">Add/Edit Contact</h2>

            <form method="POST" class="mb-4">
                <input type="hidden" name="contact_id" value="<?php echo isset($contact) ? $contact['id'] : ''; ?>">
                <input type="text" name="name" class="border border-gray-300 p-2 mb-2 w-full rounded" placeholder="Name" required value="<?php echo isset($contact) ? htmlspecialchars($contact['name']) : ''; ?>">
                <input type="email" name="email" class="border border-gray-300 p-2 mb-2 w-full rounded" placeholder="Email" value="<?php echo isset($contact) ? htmlspecialchars($contact['email']) : ''; ?>">
                <input type="text" name="phone" class="border border-gray-300 p-2 mb-4 w-full rounded" placeholder="Phone" value="<?php echo isset($contact) ? htmlspecialchars($contact['phone']) : ''; ?>">
                <button type="submit" name="<?php echo isset($contact) ? 'update_contact' : 'add_contact'; ?>" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600">
                    <?php echo isset($contact) ? 'Update Contact' : 'Add Contact'; ?>
                </button>
            </form>

            <h2 class="text-xl font-bold mb-4">Your Contacts</h2>
            <ul class="space-y-2">
                <?php foreach ($contacts as $contact): ?>
                    <li class="border-b py-2 flex justify-between items-center">
                        <span class="font-semibold"><?php echo htmlspecialchars($contact['name']); ?></span>
                        <div>
                            <a href="?edit=<?php echo $contact['id']; ?>" class="text-blue-500 hover:underline">Edit</a>
                            <a href="?delete=<?php echo $contact['id']; ?>" class="text-red-500 hover:underline ml-4">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
</body>
</html>
