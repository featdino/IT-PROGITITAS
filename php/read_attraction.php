<?php

session_start(); 
require 'db.php'; 
if (!isset($_SESSION['attraction_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}

$attraction_id = $_SESSION['attraction_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$street_address = $_POST['street_address'];
$total_visits = $_POST['total_vists'];
$avg_rating = $_POST['avg_rating'];

$read = $conn->query("SELECT * FROM attraction");
$total_attractions = $read->num_rows;

    if(isset($_GET['sort']) && $_GET['sort'] == 'desc'){
        $result = $conn->query("SELECT * FROM attractions DESC");
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
                <td><?= htmlspecialchars($row['total_vists']) ?></td>
                <td><?= htmlspecialchars($row['avg_rating']) ?></td>
                <td>
                    <a href="update_attraction.php?id=<?= $row['id']?>">Update</a>
                    <a href="delete_attraction.php?id=<?= $row['id']?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php 
            endwhile;
        ?>
        </table>
        <br>
        <a href="read_attraction.php?sort=desc" class="btn">Sort Descending</a>
        <a href="read_attraction.php" class="btn">Default View</a>


    <?php 
        echo "<p>Total Attractions: " . $total_attractions . "</p>";
    ?>
</body>
</html>
