<?php
// dashboard.php
session_start();
include '../db.php';
if (!isset($_SESSION['user_id'])) header('Location: ../index.php');
$books = $db->prepare("SELECT * FROM books WHERE user_id = ?");
$books->execute([$_SESSION['user_id']]);
?>
<link rel="stylesheet" href="../styles/style.css">
<a href="add_book.php">Add Book</a> | <a href="logout.php">Logout</a>
<h2>Your Books</h2>
<?php foreach ($books as $book): ?>
    <div class="book-card">
        <h3><?= htmlspecialchars($book['title']) ?> (<?= $book['year'] ?>)</h3>
        <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><?= nl2br(htmlspecialchars($book['recommendations'])) ?></p>
        <a href="edit_book.php?id=<?= $book['id'] ?>">Edit</a> |
        <a href="delete_book.php?id=<?= $book['id'] ?>">Delete</a>
    </div>
<?php endforeach; ?>