<?php
session_start();
require 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT user_id, username, password, role FROM user WHERE username = '$username'");

    if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
            $_SESSION['user_id']  = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // redirect based on role
            if ($row['role'] === 'admin') {
                header("Location: read_attraction.php");
            } 
            else {
                header("Location: home.php");
            }
            exit();
        }
    }
    $error = "Invalid username or password.";
}

$pageTitle = "Log In";
$pageStyle = "account.css";
include('header-account.php'); 
?>
    
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
