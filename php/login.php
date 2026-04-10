<?php
session_start();
require 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT user_id, username, password FROM user WHERE username = '$username'");

    if ($row = mysqli_fetch_assoc($result)) {
            if (md5($password) == $row['password'])  {
            $_SESSION['user_id']  = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: home.php");
            exit();
        }
    }
    $error = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Off-Radar | Welcome</title>

    <link rel = "icon" type = "image/png" href = "../images/logo-icon.png">

    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap">
    
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel = "stylesheet" type = "text/css" href = "../css/account.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="home.html"><img src="../images/logo.png" alt="Off-Radar Logo"></a>
        </div>
    </header>
    
    <section class="details-container">
        <div class="login">
            <h3>Welcome back</h3>
            <p>Please enter your details</p>

            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form class="login-form" method="POST" action="login.php">
                <input type="text" name="username" placeholder="Username" autocomplete="off" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span id="toggle-password" class="toggle-icon">
                    <i class="fas fa-eye-slash" id="toggle-password-icon"></i>
                </span><br>
                <input type="submit" class="submit-btn" name="submit" value="Log In">
            </form>

            <p class="ask">Don't have an account yet?</p>
            <a href="register.php"><button id="to-register" class="change-button">Sign Up</button></a>
        </div>
    </section>

    <script src="../javascript/account.js"></script>
</body>
</html>
