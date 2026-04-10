<?php
session_start(); 
require 'db.php'; 

// if($_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }

$admin_user_id = $_SESSION['user_id'];

$attractions_query = "SELECT attraction_id, name FROM attraction ORDER BY name";
$attraction_result = mysqli_query($conn, $attractions_query);

if (isset($_POST['submit'])) {
    $image_url = $_POST['image_url'];
    $is_official = isset($_POST['is_official']) ? 1 : 0;
    $attraction_id = $_POST['attraction_id'];
    $user_id = $admin_user_id;

    $insert = "INSERT INTO gallery (image_url, is_official, attraction_id, user_id)
                VALUES ('$image_url', '$is_official' , '$attraction_id', '$user_id')";

    if (mysqli_query($conn, $insert)) {
        header("Location: read_gallery.php");
        exit();
    }else{
        echo "<p>Error: " . $insert . "<br>" . mysqli_error($conn) . "</p>";   
    }
    
    mysqli_close($conn);
}
?>
<html>
<head>
    <title>Add Gallery Image</title>
</head>
<body>
    <h2>Add New Gallery Image</h2>
    
    <form method="POST">
        <label>Image URL:</label><br>
        <input type="text" name="image_url" required placeholder="images/filename.jpg"><br><br>
        
        <label>Official Image:</label>
        <input type="checkbox" name="is_official" value="1"><br><br>
        
        <label>Attraction:</label><br>
        <select name="attraction_id" required>
            <option value="">-- Select Attraction --</option>
            <?php while($row = mysqli_fetch_assoc($attractions_result)): ?>
                <option value="<?= $row['attraction_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <p><strong>Uploading as:</strong> <?= $_SESSION['username'] ?> (Admin)</p>
        
        <input type="submit" name="submit" value="Add Image">
    </form>
    
    <br>
    <a href="read_gallery.php">Back to Gallery</a>
</body>
</html>