<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){

$city_name = trim($_POST['city_name']);
$province = trim($_POST['province']);


    $insert = "INSERT INTO city (city_name, province) 
    VALUES('$city_name', '$province')";
    
    if(mysqli_query($conn, $insert)){
        echo "<p>Entry inserted successfully. </p>";
        header("Location: read_city.php");
    }else{
        echo "<p>Error: " . $insert . "<br>" . mysqli_error($conn) . "</p>";
    }
       mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create City</title>
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
                <h2>Create City</h2>
                <p>Add a new city record to the database.</p>
            </div>

            <div class="record-switch-tabs">
                <a href="create_attraction.php" class="switch-tab">Attraction</a>
                <a href="create_user.php" class="switch-tab">User</a>
                <a href="create_city.php" class="switch-tab active">City</a>
            </div>

            <section class="record-panel" style="display:block; height:100%;">
                <form class="record-form" method="POST" action="">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="city_name">City Name</label>
                            <input type="text" id="city_name" name="city_name" placeholder="Enter city name" required>
                        </div>

                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" id="province" name="province" placeholder="Enter province" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="primary-btn">Create City</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>