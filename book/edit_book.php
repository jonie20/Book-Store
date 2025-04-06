<?php
session_start();
include '../db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE books SET title=?, author=?, year=?, recommendations=? WHERE id=? AND user_id=?");
    $stmt->execute([
        $_POST['title'],
        $_POST['author'],
        $_POST['year'],
        $_POST['recommendations'],
        $id,
        $_SESSION['user_id']
    ]);
    header('Location: dashboard.php');
}
$book = $db->prepare("SELECT * FROM books WHERE id=? AND user_id=?");
$book->execute([$id, $_SESSION['user_id']]);
$data = $book->fetch();
?>
<link rel="stylesheet" href="../styles/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<form method="post" class="book-form">
    <h3>Edit Book</h3>
    <input name="title" value="<?= htmlspecialchars($data['title']) ?>" required />
    <input name="author" value="<?= htmlspecialchars($data['author']) ?>" required />
    <input name="year" type="number" value="<?= $data['year'] ?>" required />
    <textarea name="recommendations"><?= htmlspecialchars($data['recommendations']) ?></textarea>
    <button type="submit">Update</button>
</form>