<?php
// Handling session and database connection for user registration
session_start();
include 'db.php';
//capture form data and register user
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
<link rel="stylesheet" href="styles/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
<form method="post" class="auth-form">
    <h3>Register</h3>
    <input name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Register</button>
</form>