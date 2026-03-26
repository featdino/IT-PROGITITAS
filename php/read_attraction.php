<?php

session_start(); 
require 'db.php'; 
if (!isset($_SESSION['attraction_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}

$attraction_id = $_SESSION['attraction_id'];
$read = $conn->query("SELECT * FROM attraction");
$total_attractions = $read->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Attractions</title>
</head>
<body>
    <header>
        <nav>
            <li><a href="read_attraction.php">All Attractions</a></li>
            <li><a href="create_attraction.php">New Attraction</a></li>
            <li><a href="logout.php">Logout</a></li>
        </nav>
    </header>
    <h2>View All Attractions</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Street Address</th>
            <th>Total Visits</th>
            <th>Average Rating</th>
        </tr>
        <?php
        while ($row = $read->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['attraction_id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['street_address']) ?></td>
            <td><?= htmlspecialchars($row['total_visits']) ?></td>
            <td><?= htmlspecialchars($row['avg_rating']) ?></td>
            <td>
                <a href="update_attraction <?= $row['attraction_id'] ?>">Update</a>
                <a href="delete_attraction <?= $row['attraction_id'] ?>"onclick = "return confirm('Are you sure')">Delete</a>
            </td>
        </tr>
        <?php
        endwhile;
        ?>
    </table>

    <?php
        echo "<p>Total Attractions: ". $total_attractions . "</p>";
    ?>
</body>
</html>