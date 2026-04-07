<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$read = $conn->query("SELECT city_name, province FROM cities WHERE id = $id")-> fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $city_name = $_POST['city_name'];
    $province = $_POST['province'];

    $update = $conn->prepare("UPDATE cities SET city_name= ?, province= ? WHERE id= ?");
    $update ->bind_param("ssi", $city_name, $province, $id);
    $update ->execute();
    header("Location:read_city.php");
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
            <li><a href="create_city.php">New City</a><li>
            <li><a href="read_city.php">All Cities</a><li>
            <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
    </header>
    <h2>Update City Information</h2>
        <form method="POST">
            City Name: <input name="city_name" required value="<?=  htmlspecialchars($read['city_name']) ?>"><br>
            Province: <input name="province" required value="<?= htmlspecialchars($read['province']) ?>"><br>
        </form>

        <input type="submit" name="submit" value="Submit">
</body>
</html>
