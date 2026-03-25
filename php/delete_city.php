<?php

session_start(); 
require 'db.php'; 
if (!isset($_SESSION['city_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}

$city_id= $_SESSION['city_id'];
$delete = $conn->query("DELETE * FROM cities WHERE city_id = '$city_id'");
header("Location: read_city.php");
?>