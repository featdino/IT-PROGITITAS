<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$attraction_id = $_GET['attraction_id'];
$delete = $conn->query("DELETE FROM attraction WHERE attraction_id = '$attraction_id'");
header("Location: read_attraction.php");

?>