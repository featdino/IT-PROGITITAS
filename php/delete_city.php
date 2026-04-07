<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$city_id= $_GET['city_id'];
$delete = $conn->query("DELETE FROM cities WHERE city_id = '$city_id'");
header("Location: read_city.php");
?>