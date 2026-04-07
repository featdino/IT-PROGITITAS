<?php

session_start(); 
require 'db.php'; 


if(isset($_POST['submit'])){

$city_name = trim($_POST['city_name']);
$province = trim($_POST['province']);


    $insert = "INSERT INTO city (city_name, province) 
    VALUES('$city_name', '$province')";
    
    if(mysqli_query($conn, $insert)){
        echo "<p>Entry inserted successfully. </p>";
        header("Location: read_city.php");
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
    <title>Add Cities</title>
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
    <h2>Add Cities</h2>

    <form method="post" action="">

    <label for="name">Name:</label><br>
        <input type="text" id="city_name" name="city_name" required><br><br>
    <label for="province">Province:</label><br>
        <input type="text" id="province" name="province" required><br><br>
    <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
