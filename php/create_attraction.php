<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $street_address = $_POST['street_address'];
    $total_visits = $_POST['total_visits'];
    $avg_rating = $_POST['avg_rating'];
    $img_path = $_POST['img_path'];

    $insert = "INSERT INTO attraction (name, description, street_address ,total_visits, avg_rating, img_path) 
    VALUES ('$name', '$description', '$street_address', '$total_visits', '$avg_rating', '$img_path')";

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
        <input type="number" name="avg_rating" id="avg_rating"  required min="0" max="5"><br><br>
    <label for="img_path">Image Path:</label><br>
        <input type="text" name="img_path" id="img_path" required ><br><br>

    <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
