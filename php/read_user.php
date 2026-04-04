<?php
session_start(); 
require 'db.php'; 


// Fetch all users with their city information using JOIN
$query = "SELECT u.user_id, u.name, c.city_name, c.province 
          FROM users u 
          LEFT JOIN city c ON u.city_id = c.city_id 
          ORDER BY u.user_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Users</title>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="create_user.php">New User</a><li>
            <li><a href="read_users.php">All Users</a><li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h2>All Users</h2>

    <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>City</th>
                <th>Province</th>
            </tr>

            <?php 
                while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['city_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['province']); ?></td>
                </tr>
        <?php 
            endwhile;
         ?>
    </table>
</body>
</html>