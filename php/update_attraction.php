<?php

session_start(); 
require 'db.php'; 


    $attraction_id = $_GET['attraction_id'];
    $read = $conn->query("SELECT name, description, street_address, total_visits, avg_rating, img_path FROM attraction
    WHERE attraction_id = $attraction_id ")->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD']== "POST") {
        $name = $_POST['name'];
        $desciption = $_POST['description'];
        $street_address = $_POST['street_address'];
        $total_visits = $_POST['total_visits'];
        $avg_rating = $_POST['avg_rating'];
        $img_path = $_POST['img_path'];

        $update = $conn->prepare("UPDATE attraction SET name=?, description= ?, street_address=?, total_visits=?, avg_rating=?, img_path=? WHERE attraction_id= ?");
        $update->bind_param("sssidsi", $name, $desciption, $street_address, $total_visits, $avg_rating, $img_path, $attraction_id);  
        
        if ($update->execute()) {
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
            <label>Name:</label>
                <input name="name" required value="<?= htmlspecialchars($read['name']) ?>"> <br>
           <label>Description:</label> 
                 <input name="description" required value="<?= htmlspecialchars($read['description']) ?>"> <br>
            <label>Street Address:</label>
                 <input name="street_address" required value="<?= htmlspecialchars($read['street_address']) ?>"><br>
            <label>Total Visits:</label>
                <input name="total_visits" required value="<?= htmlspecialchars($read['total_visits']) ?>"><br>
            <label>Average Rating:</label>
                <input name="avg_rating" required min="0" max="5" value="<?= htmlspecialchars($read['avg_rating']) ?>"><br>
            <label>Image Path:</label>
                <input name="img_path" required value="<?= htmlspecialchars($read['img_path']) ?>"><br>
            <br>
            <input type="submit" name="submit" value="Update">
        </form>
</body>
</html>
