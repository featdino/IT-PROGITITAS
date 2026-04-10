<?php
session_start();
require 'db.php';
$error = $success = '';

$query = "SELECT city_id, city_name, province FROM city ORDER BY city_name ASC";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    $city_id = $_POST['city_id'];

    if (empty($name) || empty($username) || empty($password) 
        || empty($email) || empty($city_id)) {
        $error = "All fields are required.";
    } 
    else {
        $usernameCheck = mysqli_query($conn,
            "SELECT user_id FROM user WHERE username = '$username'");

        $emailCheck = mysqli_query($conn,
            "SELECT user_id FROM user WHERE email = '$email'");

        if (mysqli_num_rows($usernameCheck) > 0 && mysqli_num_rows($emailCheck) > 0) {
            $error = "Username and email already in use.";
        } 
        elseif (mysqli_num_rows($usernameCheck) > 0) {
            $error = "Username already taken.";
        } 
        elseif (mysqli_num_rows($emailCheck) > 0) {
            $error = "Email already registered.";
        }
        else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (name, username, email, password, city_id) 
                    VALUES ('$name', '$username', '$email', '$hashed', '$city_id')";
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
            <!-- change to home.php once done -->
            <a href="home.html"><img src="../images/logo.png" alt="Off-Radar Logo"></a>
        </div>
    </header>

    <section class="details-container">
        <div class="register">
            <h3>Create Account</h3>
            <p>Please enter your details</p>

            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success ?></p>
            <?php endif; ?>

            <form class="register-form" method="POST" autocomplete="off">
                <input type="text" name="name" placeholder="Display Name" required><br>
                <input type="email" name="email" placeholder="Email Address" required><br>

                <select name="city_id" required>
                    <option value="" disabled selected hidden>Select city</option>
                    <?php while ($city = mysqli_fetch_assoc($result)): ?>
                        <option value="<?php echo $city['city_id'] ?>">
                            <?php echo htmlspecialchars($city['city_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select><br>

                <input type="text" name="username" placeholder="Create Username" required><br>
                <input type="password" name="password" id="password" placeholder="Create Password" required>
                <span id="toggle-password" class="toggle-icon">
                    <i class="fas fa-eye-slash" id="toggle-password-icon"></i>
                </span><br>
                <input type="submit" class="submit-btn" name="submit" value="Create Account">
            </form>

            <p class="ask">Already have an account?</p>
            <a href="login.php"><button id="to-login" class="change-button">Log In</button></a>
        </div>
    </section>

    <script src="../javascript/account.js"></script>
</body>
</html>
