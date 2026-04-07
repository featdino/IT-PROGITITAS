<?php

session_start(); 
require 'db.php'; 

$city_id = $_GET['city_id'];
$read = $conn->query("SELECT city_name, province FROM city WHERE city_id = $city_id")-> fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $city_name = $_POST['city_name'];
    $province = $_POST['province'];

    $update = $conn->prepare("UPDATE city SET city_name= ?, province= ? WHERE city_id= ?");
    $update ->bind_param("ssi", $city_name, $province, $city_id);
    if($update ->execute()){
         header("Location:read_city.php");
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
    <title>Update City</title>
</head>
<body>
        <header>
        <nav>
            <ul>
            <li><a href="create_city.php">New City</a></li>
            <li><a href="read_city.php">All Cities</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
    </header>
    <h2>Update City Information</h2>
        <form method="POST">
            <label>City Name:</label>
                 <input name="city_name" required value="<?=  htmlspecialchars($read['city_name']) ?>"><br>
            <label>Province:</label> <input name="province" required value="<?= htmlspecialchars($read['province']) ?>"><br><br>

        <input type="submit" name="submit" value="Update">
         </form>
</body>
</html>
