<?php
//admin side
session_start(); 
require 'db.php'; 

// Fetch all cities for dropdown
$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $city_id = $_POST['city_id'];

    if(!empty($name) && !empty($city_id)){
        $insert = "INSERT INTO users (name, city_id) VALUES ('$name', '$city_id')";
        
        if(mysqli_query($conn, $insert)){
            echo "<p>User created successfully!</p>";
        } else {
            echo "<p>Error: " . $insert . "<br>" . mysqli_error($conn) . "</p>";
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
    <title>Create User</title>
</head>
<body>
    <header>
        <nav>
            <li><a href="create_user.php">New User</a><li>
            <li><a href="read_users.php">All Users</a><li>
            <li><a href="logout.php">Logout</a></li>
        </nav>
    </header>
    <h2>Create User</h2>

    <form method="post" action="">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="city_id">City</label>
        <select id="city_id" name="city_id" required>
            <option value="">-- Select City --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
