<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

$categories_query = "SELECT category_id, category, main_class FROM category ORDER BY main_class, category";
$categories_result = mysqli_query($conn, $categories_query);

if (isset($_POST['submit'])) {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $street_address = $_POST['street_address'];
    $total_visits = $_POST['total_visits'];
    $avg_rating = $_POST['avg_rating'];
    $city_id = $_POST['city_id'];
    $local_rating = $_POST['local_rating'];
    $gem_score = $_POST['gem_score'];
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    $insert = "INSERT INTO attraction (name, description, street_address ,total_visits, avg_rating, city_id, local_rating, gem_score) 
    VALUES ('$name', '$description', '$street_address', '$total_visits', '$avg_rating', '$city_id', '$local_rating', '$gem_score')";

    if (mysqli_query($conn, $insert)) {
        $attraction_id = mysqli_insert_id($conn);

        if(!empty($categories)){
            foreach($categories as $category_id){
                $insert_cat = "INSERT INTO attraction_category (attraction_id, category_id) VALUES ('$attraction_id', '$category_id')";
                mysqli_query($conn, $insert_cat);
            }
          }
        header("Location: read_attraction.php");
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
    <title>Create Attraction</title>
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
                <h2>Create Attraction</h2>
                <p>Add a new attraction record to the database.</p>
            </div>
            <div class="record-switch-tabs">
                <a href="create_attraction.php" class="switch-tab active">Attraction</a>
                <a href="create_user.php" class="switch-tab">User</a>
                <a href="create_city.php" class="switch-tab">City</a>
            </div>

            <section class="record-panel attraction-panel" style="display:block; height:100%;">
                <form class="record-form" method="POST" action="">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Attraction Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter attraction name" required>
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
                            <label for="street_address">Street Address</label>
                            <input type="text" id="street_address" name="street_address" placeholder="Enter street address" required>
                        </div>

                        <div class="form-group full-width">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="5" placeholder="Enter attraction description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="total_visits">Total Visits</label>
                            <input type="number" id="total_visits" name="total_visits" value="0" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="avg_rating">Average Rating</label>
                            <input type="number" step="0.01" id="avg_rating" name="avg_rating" placeholder="Enter average rating">
                        </div>

                        <div class="form-group">
                            <label for="local_rating">Local Rating</label>
                            <input type="number" step="0.01" id="local_rating" name="local_rating" placeholder="Enter local rating">
                        </div>

                        <div class="form-group">
                            <label for="gem_score">Gem Score</label>
                            <input type="number" step="0.01" id="gem_score" name="gem_score" placeholder="Enter gem score">
                        </div>

                        <div class="form-group full-width">
                            <p class="form-label">Categories</p>
                            <div class="checkbox-group">
                                <?php
                                $current_main_class = '';
                                mysqli_data_seek($categories_result, 0);
                                while($category = mysqli_fetch_assoc($categories_result)):
                                ?>
                                    <label class="checkbox-item">
                                        <span><?php echo htmlspecialchars($category['category']); ?></span>
                                        <input type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>">
                                    </label>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="primary-btn">Create Attraction</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>