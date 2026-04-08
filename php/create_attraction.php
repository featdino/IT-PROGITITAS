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

if (isset($_POST['submit'])) {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $street_address = $_POST['street_address'];
    $total_visits = $_POST['total_visits'];
    $avg_rating = $_POST['avg_rating'];
    $city_id = $_POST['city_id'];

    $insert = "INSERT INTO attraction (name, description, street_address ,total_visits, avg_rating, city_id) 
    VALUES ('$name', '$description', '$street_address', '$total_visits', '$avg_rating', '$city_id')";

    if (mysqli_query($conn, $insert)) {
        echo "<p>Entry inserted successfully. </p>";
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
    <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>
    <label for="description">Description:</label><br>
        <input type="text" name="description" id="description" required><br><br>
    <label for="street_address">Street Address:</label><br>
        <input type="text" name="street_address" id="street_address" required><br><br>
    <label for="total_visits">Total Visits:</label><br>
        <input type="text" name="total_visits" id="total_visits" required><br><br>
    <label for="avg_rating">Average Rating:</label><br>
        <input type="number" step="0.01" name="avg_rating" id="avg_rating" ><br><br>
    
    <label for="city_id">City</label>
        <select id="city_id" name="city_id" required>
            <option value="">-- Select City --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
            <?php endwhile; ?>
        </select><br>

    <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
