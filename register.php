<?php
// Structure Overview (file-wise):
// index.php               - Login Page
// register.php            - Registration Page
// dashboard.php           - User Dashboard + Book List
// add_book.php            - Form to add a book
// edit_book.php           - Form to edit a book
// delete_book.php         - Script to delete a book
// logout.php              - Logout script
// db.php                  - MySQL DB connection


// register.php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        header('Location: index.php');
    } else {
        echo "Username already exists.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<form method="post" class="auth-form">
    <input name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Register</button>
</form>