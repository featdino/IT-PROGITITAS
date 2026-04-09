<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$attraction_id = $_POST['attraction_id'];

// only allow upload if visited
$query = "SELECT * FROM visits WHERE user_id='$user_id' AND attraction_id='$attraction_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("You must visit first.");
}

// ensure file uploaded without errors
if (isset($_FILES['visitor_image']) && $_FILES['visitor_image']['error'] === 0) {

    // get file name and temporary address of the uploaded file
    $file_name = $_FILES['visitor_image']['name'];
    $tmp_name = $_FILES['visitor_image']['tmp_name'];

    // generate unique filename
    $new_name = time() . "_" . basename($file_name);

    $upload_path = "../images/" . $new_name;

    // move file from temp location to images folder
    if (move_uploaded_file($tmp_name, $upload_path)) {

        // save to DB (visitor image = is_official = 0)
        mysqli_query($conn, "
            INSERT INTO gallery (attraction_id, image_url, is_official, user_id)
            VALUES ('$attraction_id', 'images/$new_name', 0, '$user_id')
        ");

    } 
    else {
        die("Upload failed.");
    }

} 
else {
    die("No file uploaded.");
}

// redirect back
header("Location: attraction.php?id=" . $attraction_id);
exit();
?>