<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = $conn->query("SELECT * FROM city");
$total_cities = $read->num_rows;

    if(isset($_GET['sort']) && $_GET['sort'] == 'letter'){
        $result = $conn->query("SELECT * FROM city ORDER BY city_name ASC");
    }else{
        $result = $conn->query("SELECT * FROM city");
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
        <header>
        <nav>
            <ul>
            <li><a href="create_city.php">New City</a></li>
            <li><a href="read_city.php">All Cities</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
    </header>
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
                <a href="update_city.php?city_id=<?= $row['city_id']?>">Update</a>
                <a href="delete_city.php?city_id=<?= $row['city_id']?>"onclick= "return confirm('Are you Sure')">Delete</a>

            </td>
        </tr>
    <?php
    endwhile;
    ?>
    </table>
    <br>
    <a href="read_city.php?sort=letter" class="btn">Sort By Name</a>
    <a href="read_city.php"class="btn">Default View</a>
</body>
</html>
