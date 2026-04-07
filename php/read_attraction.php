<?php

session_start(); 
require 'db.php'; 
//header("Location: admin.php");

$read = $conn->query("SELECT * FROM attraction");
$total_attractions = $read->num_rows;

    if(isset($_GET['sort']) && $_GET['sort'] == 'desc'){
        $result = $conn->query("SELECT * FROM attraction ORDER BY name ASC");
    }else{
        $result = $conn->query("SELECT * FROM attraction");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attractions</title>
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
    <h2>View Attractions</h2>
        <table>
            <tr>
                <th>Attraction ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Street Address</th>
                <th>Total Visits</th>
                <th>Average Rating</th>
            </tr>
            <?php 
                while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['attraction_id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['street_address']) ?></td>
                <td><?= htmlspecialchars($row['total_visits']) ?></td>
                <td><?= htmlspecialchars($row['avg_rating']) ?></td>
                <td>
                    <a href="update_attraction.php?id=<?= $row['attraction_id']?>">Update</a>
                    <a href="delete_attraction.php?id=<?= $row['attraction_id']?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php 
            endwhile;
        ?>
        </table>
        <br>
        <a href="read_attraction.php?sort=desc" class="btn">Sort By Name</a>
        <a href="read_attraction.php" class="btn">Default View</a>


    <?php 
        echo "<p>Total Attractions: " . $total_attractions . "</p>";
    ?>
</body>
</html>
