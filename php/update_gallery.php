<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$image_id = $_GET['image_id'];
$admin_user_id = $_SESSION['user_id'];

$read = "SELECT * FROM gallery WHERE image_id = '$image_id'";
$result = mysqli_query($conn, $read);
$gallery = mysqli_fetch_assoc($result);


$attractions_query = "SELECT attraction_id, name FROM attraction ORDER BY name";
$attractions_result = mysqli_query($conn, $attractions_query);

if (isset($_POST['submit'])) {
    $image_url = $_POST['image_url'];
    $is_official = isset($_POST['is_official']) ? 1 : 0;
    $attraction_id = $_POST['attraction_id'];

    $user_id = $gallery['user_id'];
    
    $update = "UPDATE gallery SET 
               image_url='$image_url', 
               is_official='$is_official', 
               attraction_id='$attraction_id' 
               WHERE image_id='$image_id'";
    
    if (mysqli_query($conn, $update)) {
        header("Location: read_gallery.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Gallery Image</title>
</head>
<body>
    <h2>Update Gallery Image</h2>
    
    <form method="POST">
        <label>Image URL:</label><br>
        <input type="text" name="image_url" required value="<?= htmlspecialchars($gallery['image_url']) ?>"><br><br>
        
        <label>Official Image:</label>
        <input type="checkbox" name="is_official" value="1" <?= $gallery['is_official'] ? 'checked' : '' ?>><br><br>
        
        <label>Attraction:</label><br>
        <select name="attraction_id" required>
            <option value="">-- Select Attraction --</option>
            <?php while($row = mysqli_fetch_assoc($attractions_result)): ?>
                <option value="<?= $row['attraction_id'] ?>" <?= ($row['attraction_id'] == $gallery['attraction_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['name']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        
        <p><strong>Uploaded by:</strong> User ID <?= $gallery['user_id'] ?></p>
        
        <input type="submit" name="submit" value="Update Image">
    </form>
    
    <br>
    <a href="read_gallery.php">Back to Gallery</a>
</body>
</html>