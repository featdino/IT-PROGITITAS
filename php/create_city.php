<?php
session_start(); 
require 'db.php'; 
if (!isset($_SESSION['city_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}


if(isset($_POST['submit'])){

$city_id = $_SESSION['city_id'];
$city_name = trim($_POST['city_name']);
$province = trim($_POST['province']);

if(!empty($city_name) && !empty($province)){
    $insert = "INSERT INTO city (NULL, '$city_name', '$province')";

} else{
    echo "<p>Error: " . $insert . "<br>" . mysqli_error($conn) ."</p>";
}
    mysqli_close($conn);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cities</title>
</head>
<body>
    <header>
        <nav>
            <li><a href="create_city.php">New City</a><li>
            <li><a href="read_city.php">All Cities</a><li>
            <li><a href="logout.php">Logout</a></li>

        </nav>
    </header>
    <h2>Add Cities</h2>

    <form method="post" action="">

    <label for="name">Name</label>
        <input type="text" id="city_name" name="city_name" required><br>
    <label for="province">Province</label>
        <input type="text" id="province" name="province" required><br>
    <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>