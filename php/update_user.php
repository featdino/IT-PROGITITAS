<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all cities for dropdown
$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

// Get user ID from URL
$user_id = $_GET['id'];

// Fetch user data
$user_query = "SELECT user_id, name, city_id FROM user WHERE user_id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $city_id = $_POST['city_id'];

    if(!empty($name) && !empty($city_id)){
        $update = "UPDATE user SET name='$name', city_id='$city_id' WHERE user_id=$user_id";
        
        if(mysqli_query($conn, $update)){
            echo "<p>User updated successfully!</p>";
            header("Location: read_user.php");
            exit();
        } else {
            echo "<p>Error: " . $update . "<br>" . mysqli_error($conn) . "</p>";
        }
    } else{
        echo "<p>Please fill in all fields</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="create_user.php">New User</a><li>
            <li><a href="read_user.php">All Users</a><li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h2>Update User</h2>

    <form method="post" action="">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
        
        <label for="city_id">City</label>
        <select id="city_id" name="city_id" required>
            <option value="">-- Select City --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?php echo $row['city_id']; ?>" <?php echo ($row['city_id'] == $user['city_id']) ? 'selected' : ''; ?>>
                    <?php echo $row['city_name']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
