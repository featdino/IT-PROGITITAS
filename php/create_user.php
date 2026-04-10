<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = trim($_POST['email']);
    $city_id = $_POST['city_id'];

    if(!empty($name) && !empty($username) && !empty($password) && !empty($email) && !empty($city_id)){
        $insert = "INSERT INTO user (name, username, password, email, city_id) VALUES ('$name','$username', '$password', '$email', '$city_id')";
        
        if(mysqli_query($conn, $insert)){
            echo "<p>User created successfully!</p>";
            header("Location: read_user.php");

        } else {
            echo "<p>Error: " . $insert . "<br>" . mysqli_error($conn) . "</p>";
        }
     mysqli_close($conn);
}
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="../css/create_record.css">
</head>
<body>
    <div class="page-overlay"></div>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-backdrop"></label>

    <header class="topbar">
        <div class="brand">
            <div class="logo-circle">
                <img src="../images/logo-icon.png" alt="Off-Radar logo" />
            </div>
            <h1>off-radar.</h1>
        </div>

        <div class="top-actions">
            <label for="menu-toggle" class="menu-btn" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
    </header>

        <nav class="side-menu">
        <a href="read_attraction.php">Dashboard</a>
        <a href="read_attraction.php">View Database</a>
        <a href="generate_report.php">Generate Reports</a>
        <a href="create_attraction.php">Create Attraction</a>
        <a href="create_user.php">Create User</a>
        <a href="create_city.php">Create City</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main class="create-section">
        <div class="create-shell">
            <div class="create-header">
                <h2>Create User</h2>
                <p>Add a new user record to the database.</p>
            </div>

            <div class="record-switch-tabs">
                <a href="create_attraction.php" class="switch-tab">Attraction</a>
                <a href="create_user.php" class="switch-tab active">User</a>
                <a href="create_city.php" class="switch-tab">City</a>
            </div>

            <section class="record-panel user-panel" style="display:block; height:100%;">
                <form class="record-form" method="POST" action="">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter full name" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Enter username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter email" required>
                        </div>

                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select id="city_id" name="city_id" required>
                                <option value="">Select city</option>
                                <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                                    <option value="<?php echo $row['city_id']; ?>">
                                        <?php echo htmlspecialchars($row['city_name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter password" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="primary-btn">Create User</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>