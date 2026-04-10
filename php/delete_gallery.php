<?php
session_start(); 
require 'db.php'; 

$image_id = $_GET['image_id'];
$delete = $conn ->query("DELETE FROM gallery WHERE image_id = '$image_id'");
header("Location: read_gallery.php");
exit();
?>