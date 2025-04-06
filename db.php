<?php
// db.php
$db = new PDO('mysql:host=localhost;dbname=book_manager', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>