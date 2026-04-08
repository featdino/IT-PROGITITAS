<?php
//eto yung page before clicking the attraction
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = $conn->query("SELECT * FROM attraction");


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
            <th>Image</th>
        </tr>
        <?php 
            while ($row = $read->fetch_assoc()):
                
                $img_query = "SELECT image_url FROM gallery WHERE attraction_id = '{$row['attraction_id']}' LIMIT 1";
                $img_result = $conn->query($img_query);
                $image = $img_result->fetch_assoc();
        ?>
        <tr>
            <td><?= htmlspecialchars($row['attraction_id']) ?></td>
            <td><a href="attraction_details.php?attraction_id=<?= $row['attraction_id'] ?>"><?= htmlspecialchars($row['name']) ?></a></td>
            <td>
                <?php if($image && $image['image_url']): ?>
                    <img src="<?= htmlspecialchars($image['image_url']) ?>" width="50" height="50">
                <?php else: ?>
                    No image
                <?php endif; ?>
            </td>
        </tr>
        <?php 
            endwhile;
        ?>
    </table>
    
    <br>

</body>
</html>