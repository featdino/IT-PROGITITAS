<?php
session_start();
require 'db.php';
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($name) || empty($username) || empty($password) || empty($email)) {
        $error = "All fields are required.";
    } 
    else {
        $usernameCheck = mysqli_query($conn,
            "SELECT id FROM user WHERE username = '$username'");

        $emailCheck = mysqli_query($conn,
            "SELECT id FROM user WHERE email = '$email'");

        if (mysqli_num_rows($usernameCheck) > 0) {
            $error = "Username already taken.";
        }
        else if (mysqli_num_rows($emailCheck) > 0) {
            $error = "Email already registered.";
        }
        else if (mysqli_num_rows($usernameCheck) > 0 && mysqli_num_rows($emailCheck) > 0) {
            $error = "Username and email already in use.";
        }
        else {
            $hashed = mysqli_real_escape_string($conn, password_hash($password, PASSWORD_DEFAULT));
            $sql = "INSERT INTO user (name, username, email, password) VALUES ('$name', '$username', '$email', '$hashed')";
            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! <a href='login.php'>Log in here</a>.";
            } 
            else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Off-Radar</title>
    <!-- link the css file for this page once done -->
    <link rel="stylesheet" href="">
</head>
<body>
        <!-- palagay nlng yung css class used for this div -->
<div class="auth-container">
    <h2>Create Account</h2>
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Display Name</label>
        <input type="text" name="name" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
