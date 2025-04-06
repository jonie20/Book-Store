<?php
// delete_book.php
session_start();
include 'db.php';
$stmt = $db->prepare("DELETE FROM books WHERE id=? AND user_id=?");
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);
header('Location: dashboard.php');
?>