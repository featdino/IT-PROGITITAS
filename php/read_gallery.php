<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = "SELECT g.*, a.name as attraction_name, u.name as user_name 
          FROM gallery g
          LEFT JOIN attraction a ON g.attraction_id = a.attraction_id
          LEFT JOIN user u ON g.user_id = u.user_id
          ORDER BY g.image_id";
$result = mysqli_query($conn, $read);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
</head>
<body>
    <h2>Gallery Images</h2>
    
    <a href="create_gallery.php">Add New Image</a>
    <br><br>
    
    <table>
            <tr>
                <th>Image ID</th>
                <th>Image</th>
                <th>Attraction</th>
                <th>Uploaded By</th>
                <th>Official</th>
                <th>Upload Date</th>
                <th>Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['image_id'] ?></td>
                <td>
                    <img src="../<?= htmlspecialchars($row['image_url']) ?>" width="80" height="60" style="object-fit: cover;">
                 </td>
                <td><?= htmlspecialchars($row['attraction_name']) ?></td>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= $row['is_official'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['upload_date'] ?></td>
                <td>
                    <a href="update_gallery.php?image_id=<?= $row['image_id'] ?>">Edit</a>
                    <a href="delete_gallery.php?image_id=<?= $row['image_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                 </td>
            </tr>
            <?php endwhile; ?>
    </table>
</body>
</html>