<?php

session_start(); 
require 'db.php'; 

// if($_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Fetch all cities for dropdown
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
    <title>Create Attractions</title>
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

       <h2>New Attractions</h2>
    <form method="POST" action="">    
    <label for="name"><strong>Name:</strong></label><br>
        <input type="text" name="name" id="name" required><br><br>
    <label for="description"><strong>Description:</strong></label><br>
        <input type="text" name="description" id="description" required><br><br>
    <label for="street_address"><strong>Street Address:</strong></label><br>
        <input type="text" name="street_address" id="street_address" required><br><br>
    <label for="total_visits"><strong>Total Visits:</strong></label><br>
        <input type="text" name="total_visits" id="total_visits" required><br><br>
    <label for="avg_rating"><strong>Average Rating:</strong></label><br>
        <input type="number" step="0.01" name="avg_rating" id="avg_rating" ><br><br>

    
    <label for="city_id"><strong>City:</strong></label><br>
        <select id="city_id" name="city_id" required>
            <option value="">-- Select City --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

    <label for="local_rating"><strong>Local Rating:</strong></label><br>
        <input type="number" step="0.01" name="local_rating" id="local_rating" ><br><br>
    <label for="gem_score"><strong>Gem Score:</strong></label><br>
        <input type="number" step="0.01" name="gem_score" id="gem_score" ><br><br>

    <label>Categories:</strong></label><br>
        <?php 
        $current_main_class = '';
        mysqli_data_seek($categories_result, 0);
        while($category = mysqli_fetch_assoc($categories_result)): 
            if ($current_main_class != $category['main_class']):
                $current_main_class = $category['main_class'];
                echo "<strong>" . htmlspecialchars($current_main_class) . "</strong><br>";
            endif;
        ?>
            <input type="checkbox" name="categories[]" value="<?= $category['category_id'] ?>">
            <label><?= htmlspecialchars($category['category']) ?></label><br>
        <?php endwhile; ?>

        <br>

    <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
