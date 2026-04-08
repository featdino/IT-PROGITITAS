<?php
//eto yung page after clicking the attraction
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$attraction_id = $_GET['attraction_id'];

// Fetch attraction details with city
$detail_query = "SELECT a.*, c.city_name, c.province 
                 FROM attraction a 
                 LEFT JOIN city c ON a.city_id = c.city_id 
                 WHERE a.attraction_id = '$attraction_id'";
$detail_result = $conn->query($detail_query);
$attraction = $detail_result->fetch_assoc();

// Fetch categories for this attraction
$cat_query = "SELECT cat.category, cat.main_class 
              FROM category cat
              JOIN attraction_category ac ON cat.category_id = ac.category_id
              WHERE ac.attraction_id = '$attraction_id'";
$cat_result = $conn->query($cat_query);


$img_query = "SELECT image_url FROM gallery 
              WHERE attraction_id = '$attraction_id' AND is_official = 1 
              LIMIT 1";
$img_result = $conn->query($img_query);
$official_image = $img_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($attraction['name']) ?> - Details</title>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="create_attraction.php">Create Attractions</a></li>
            <li><a href="read_attraction.php">View Attractions</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h2><?= htmlspecialchars($attraction['name']) ?></h2>
    
    <?php if($official_image && $official_image['image_url']): ?>
        <img src="<?= htmlspecialchars($official_image['image_url']) ?>" width="300" height="200">
    <?php else: ?>
        <p>No official image available.</p>
    <?php endif; ?>
    
    <p><strong>Attraction ID:</strong> <?= $attraction['attraction_id'] ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($attraction['description']) ?></p>
    <p><strong>Street Address:</strong> <?= htmlspecialchars($attraction['street_address']) ?></p>
    <p><strong>City:</strong> <?= htmlspecialchars($attraction['city_name']) ?> (<?= htmlspecialchars($attraction['province']) ?>)</p>
    <p><strong>Total Visits:</strong> <?= $attraction['total_visits'] ?></p>
    <p><strong>Average Rating:</strong> <?= $attraction['avg_rating'] ?></p>
    
    <p><strong>Categories:</strong><br>
    <?php 
    if($cat_result->num_rows > 0) {
        while($cat = $cat_result->fetch_assoc()) {
            echo "- " . htmlspecialchars($cat['category']) . " (" . htmlspecialchars($cat['main_class']) . ")<br>";
        }
    } else {
        echo "No categories assigned.";
    }
    ?>
    </p>
    
    <br>
    <a href="update_attraction.php?attraction_id=<?= $attraction['attraction_id'] ?>">Update</a>
    <a href="delete_attraction.php?attraction_id=<?= $attraction['attraction_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    <a href="read_attraction.php">Back to All Attractions</a>

</body>
</html>