<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = $conn->query("SELECT u.user_id, u.name, u.username, u.password, u.email, c.city_name, c.province, u.role
          FROM user u 
          LEFT JOIN city c ON u.city_id = c.city_id 
          ORDER BY u.user_id");

$result = mysqli_query($conn, $read);
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
            <li><a href="create_user.php">New User</a></li>
            <li><a href="read_user.php">All Users</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h2>All Users</h2>

    <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>City</th>
                <th>Province</th>
                <th>Role</th>
            </tr>

            <?php 
                while ($row = $read->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['city_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['province']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td>
                        <a href="update_user.php?user_id=<?= $row['user_id']?>">Update</a>
                        <a href="delete_user.php?user_id=<?= $row['user_id']?>"onclick= "return confirm('Are you Sure')">Delete</a>
                    </td>
                </tr>
        <?php 
            endwhile;
         ?>
    </table>
</body>
</html>