<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

    // Fetch all cities for dropdown
    $cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
    $cities_result = mysqli_query($conn, $cities_query);

    $attraction_id = $_GET['attraction_id'];
    $read = $conn->query("SELECT name, description, street_address, total_visits, avg_rating, city_id FROM attraction
    WHERE attraction_id = $attraction_id ")->fetch_assoc();

    
    $categories_query = "SELECT category_id, category, main_class FROM category ORDER BY main_class, category";
    $categories_result = mysqli_query($conn, $categories_query);
    $current_categories = [];
    $cat_result = $conn->query("SELECT category_id FROM attraction_category WHERE attraction_id = $attraction_id");
    while($cat_row = $cat_result->fetch_assoc()) {
        $current_categories[] = $cat_row['category_id'];
}

    if ($_SERVER['REQUEST_METHOD']== "POST") {
        $name = $_POST['name'];
        $desciption = $_POST['description'];
        $street_address = $_POST['street_address'];
        $total_visits = $_POST['total_visits'];
        $avg_rating = $_POST['avg_rating'];
        $city_id = $_POST['city_id'];
        $local_rating = $_POST['local_rating'];
        $gem_score = $_POST['gem_score'];
        $categories = isset($_POST['categories']) ? $_POST['categories'] : [];


        $update = $conn->prepare("UPDATE attraction SET name=?, description= ?, street_address=?, total_visits=?, avg_rating=?, city_id=?, local_rating=?, gem_score=? WHERE attraction_id= ?");
        $update->bind_param("sssididdi", $name, $desciption, $street_address, $total_visits, $avg_rating, $city_id, $local_rating, $gem_score, $attraction_id);  
        
       if ($update->execute()) {
            $conn->query("DELETE FROM attraction_category WHERE attraction_id='$attraction_id'");
            
            if (!empty($categories)) {
                foreach ($categories as $category_id) {
                    $conn->query("INSERT INTO attraction_category (attraction_id, category_id) VALUES ('$attraction_id', '$category_id')");
                }
            }
            
            header("Location: read_attraction.php");
            exit();
        }else{
            echo "Error updating record: " . $conn->error;
        }
        $update->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Attraction</title>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="read_attraction.php">View Attractions</a></li>
            <li><a href="create_attraction.php">Create New</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
        <h2>Update Attractions</h2>

        <form method="POST">
            <label><strong>Name:</strong></label>
                <input name="name" required value="<?= htmlspecialchars($read['name']) ?>"> <br><br>
           <label><strong>Description:</strong></label> 
                 <input name="description" required value="<?= htmlspecialchars($read['description']) ?>"> <br><br>
            <label><strong>Street Address:</strong></label>
                 <input name="street_address" required value="<?= htmlspecialchars($read['street_address']) ?>"><br><br>
            <label><strong>Total Visits:</strong></label>
                <input name="total_visits" required value="<?= htmlspecialchars($read['total_visits']) ?>"><br><br>
            <label><strong>Average Rating:</strong></label>
                <input name="avg_rating" required min="0" max="5" value="<?= htmlspecialchars($read['avg_rating']) ?>"><br><br>
            <label><strong>City:</strong></label>
            <select name="city_id">
            <option value="">-- Select City  --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?= $row['city_id'] ?>" <?= ($row['city_id'] == $read['city_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['city_name']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label><strong>Categories:</strong></label><br>
            <?php 
            $current_main_class = '';
            mysqli_data_seek($categories_result, 0);
            while($category = mysqli_fetch_assoc($categories_result)): 
                if ($current_main_class != $category['main_class']):
                    $current_main_class = $category['main_class'];
                    echo "<strong>" . htmlspecialchars($current_main_class) . "</strong><br>";
                endif;
                $checked = in_array($category['category_id'], $current_categories) ? 'checked' : '';
            ?>
                <input type="checkbox" name="categories[]" value="<?= $category['category_id'] ?>" <?= $checked ?>>
                <label><?= htmlspecialchars($category['category']) ?></label><br>
            <?php endwhile; ?>

            <br>            
            <input type="submit" name="submit" value="Update">
        </form>
</body>
</html>
