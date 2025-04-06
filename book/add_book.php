<?php
session_start();
include '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("INSERT INTO books (user_id, title, author, year, recommendations) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['title'],
        $_POST['author'],
        $_POST['year'],
        $_POST['recommendations']
    ]);
    header('Location: dashboard.php');
}
?>
<link rel="stylesheet" href="../styles/style.css">
<form method="post" class="book-form">
    <input name="title" placeholder="Title" required />
    <input name="author" placeholder="Author" required />
    <input name="year" type="number" placeholder="Year" required />
    <textarea name="recommendations" placeholder="Your thoughts..."></textarea>
    <button type="submit">Save</button>
</form>