<?php
session_start();
require 'db.php';

/*if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}*/

$image_id = $_GET['image_id'];
$conn->query("DELETE FROM gallery WHERE image_id = '$image_id'");

// If called from update_attraction, go back there instead of read_gallery
if (isset($_GET['redirect']) && $_GET['redirect'] === 'update_attraction' && isset($_GET['attraction_id'])) {
    $attraction_id = intval($_GET['attraction_id']);
    header("Location: update_attraction.php?attraction_id=$attraction_id");
} else {
    header("Location: read_gallery.php");
}
exit();
?>
