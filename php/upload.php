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

$files = $_FILES['visitor_image'];
$valid_files = [];

// store indexes of files w/ no upload error
for ($i = 0; $i < count($files['name']); $i++) {
    if ($files['error'][$i] === 0) {
        $valid_files[] = $i;
    }
}

if (count($valid_files) > 5) {
    die("Maximum of 5 files allowed.");
}

// allowed file types
$allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
$allowed_mime_types = ['image/jpeg','image/png','image/webp','image/avif'];

// loop through each uploaded file that have no errors (via their indexes) and validate
foreach ($valid_files as $i) {

    // get file name, size and temporary address of the uploaded file
    $file_name = $files['name'][$i];
    $tmp_name = $files['tmp_name'][$i];
    $file_size = $files['size'][$i];

    // 5mb max file size per file
    if ($file_size > 5 * 1024 * 1024) {
        die("$file_name is too large. Each file must be 5MB or less.");
    }

    // get file extensions and actual MIME type to be really sure it's an image and not a disguised malicious file 
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_mime = mime_content_type($tmp_name);

    if (!in_array($file_ext, $allowed_extensions) || !in_array($file_mime, $allowed_mime_types)) {
        die("$file_name has an invalid file type. Only JPG, PNG, WEBP, and AVIF are allowed.");
    }

    // generate unique filename
    $new_name = time() . "_" . $i . "_" . basename($file_name);

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

// redirect back
header("Location: attraction.php?id=" . $attraction_id);
exit();
?>