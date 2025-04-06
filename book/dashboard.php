<?php
// dashboard.php
session_start();
include '../db.php';
if (!isset($_SESSION['user_id'])) header('Location: ../index.php');
$books = $db->prepare("SELECT * FROM books WHERE user_id = ?");
$books->execute([$_SESSION['user_id']]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="add_book.php">Add Book</a>
            </li>
        </ul>
        <div class="d-flex">
            <a class="btn btn-outline-danger" href="logout.php">Logout</a>
        </div>
        </div>
    </div>
    </nav>
    <h2>My Books</h2>
    <?php foreach ($books as $book): ?>
        <div class="book-card">
            <h3><?= htmlspecialchars($book['title']) ?> (<?= $book['year'] ?>)</h3>
            <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
            <p><?= nl2br(htmlspecialchars($book['recommendations'])) ?></p>
            <a class="btn btn-primary" href="edit_book.php?id=<?= $book['id'] ?>">Edit</a> 
            <a class="btn btn-danger" href="delete_book.php?id=<?= $book['id'] ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</body>
</html>