<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

    $attraction_id = $_GET['attraction_id'];
    $read = $conn->query("SELECT name, description, street_address, total_visits, avg_rating FROM attraction
    WHERE attraction_id = $attraction_id ")->fetch_assoc;

    if ($_SERVER['REQUEST_METHOD']== "POST") {
        $update = $conn->prepare("UPDATE attraction SET name=?, description= ?, street_address=?, total_visits=?, avg_rating=? WHERE attraction_id= ?");
        $update = $conn->bind_param("sssiii", $name, $desciption, $street_address, $total_visits, $avg_rating, $attraction_id);  
        $update = $conn->execute();  
        header("Location: read_attraction.php");
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
            Name: <input name="name" required value="<?= htmlspecialchars($read['name']) ?>"> <br>
            Description: <input name="description" required value="<?= htmlspecialchars($read['description']) ?>"> <br>
            Street Address: <input name="street_address" required value="<?= htmlspecialchars($read['street_address']) ?>"><br>
            Total Visits:<input name="total_visits" required value="<?= htmlspecialchars($read['total_visits']) ?>"><br>
            Average Rating: <input name="avg_rating" required value="<?= htmlspecialchars($read['avg_rating']) ?>"><br>
            <br>
            <input type="submit" name="submit" value="Submit">
        </form>
</body>
</html>
