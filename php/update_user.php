<?php
session_start(); 
require 'db.php'; 

// Fetch all cities for dropdown
$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

$user_id = $_GET['user_id'];
$read = $conn->query("SELECT name,username, password, email, city_id FROM user WHERE user_id = $user_id")->fetch_assoc();

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $city_id = $_POST['city_id'];
        
    $update= $conn->prepare("UPDATE user SET name=?, username=?, password=?, email=?, city_id= ? WHERE user_id=?");
    $update->bind_param("ssssii", $name, $username, $password, $email, $city_id, $user_id);

    if($update->execute()){
        header("Location: read_user.php");
        exit();
    }else{
        echo "Error updating record: " . $conn->error;
    }
    $update->close();

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
            <li><a href="create_user.php">New User</a></li>
            <li><a href="read_user.php">All Users</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h2>Update User</h2>

    <form method="post" action="">
        <label>Name:</label>
            <input name="name" required value="<?= htmlspecialchars($read['name'])?>"><br> 
        <label>Username:</label>       
            <input name="username" required value="<?= htmlspecialchars($read['username'])?>"><br> 
        <label>Password:</label>       
            <input name="password" required value="<?= htmlspecialchars($read['password'])?>"><br> 
        <label>Email:</label>       
            <input name="email" required value="<?= htmlspecialchars($read['email'])?>"><br> 
        <label>City:</label>
            <select name="city_id">
            <option value="">-- Select City (Optional) --</option>
            <?php while($row = mysqli_fetch_assoc($cities_result)): ?>
                <option value="<?= $row['city_id'] ?>" <?= ($row['city_id'] == $read['city_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['city_name']) ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>