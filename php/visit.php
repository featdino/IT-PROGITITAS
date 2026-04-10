<!-- logic for visits -->
<?php
session_start();
require 'db.php';

// strictly only allow logged in users with "user" role to mark/unmark visits
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$attraction_id = $_POST['attraction_id'];

// Check if visited
$query = "SELECT * FROM visits WHERE user_id='$user_id' AND attraction_id='$attraction_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // unmark visit
    mysqli_query($conn, "DELETE FROM visits WHERE user_id='$user_id' AND attraction_id='$attraction_id'");
    mysqli_query($conn, "UPDATE attraction SET total_visits = total_visits - 1 WHERE attraction_id='$attraction_id'");
} else {
    // mark as visited
    mysqli_query($conn, "INSERT INTO visits (user_id, attraction_id) VALUES ('$user_id', '$attraction_id')");
    mysqli_query($conn, "UPDATE attraction SET total_visits = total_visits + 1 WHERE attraction_id='$attraction_id'");
}

// redirect back to attraction page
header("Location: attraction.php?id=" . $attraction_id);
exit();
?>