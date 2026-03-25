<?php

session_start(); 
require 'db.php'; 
if (!isset($_SESSION['city_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}


$city_id = $_SESSION['city_id'];
$read = $conn->query("SELECT * FROM cities");
$total_cities = $read->num_rows;
if(isset($_GET['sort']) && $_GET['sort'] == 'letter'){
    $result = $conn->query("SELECT * FROM cities ORDER BY ASC ");
}else{
    $read = $conn->query("SELECT * FROM cities");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cities</title>
</head>
<body>
    <h2>View Cities</h2>

    <table>
        <tr>
            <th>City ID</th>
            <th>City Name</th>
            <th>Province</th>
        </tr>
    <?php
    while($row = $result->fetch_assoc()):
    ?>

        <tr>
            <td><?= htmlspecialchars($row['city_id']) ?></td>
            <td><?= htmlspecialchars($row['city_name']) ?></td>
            <td><?= htmlspecialchars($row['province']) ?></td>
            <td>
                <a href="update_city.php=<?= $row['city_id']?>">Update</a>
                <a href="delete_city.php=<?= $row['city_id']?>"onclick= "return confirm('Are you Sure')">Delete</a>

            </td>
        </tr>
    <?php
    endwhile;
    ?>
    </table>
    <br>
    <a href="read_city.php?sort=letter" class="btn">Sort By Alpabetical</a>
    <a href="read_city.php"class="btn">Default View</a>
</body>
</html>
