<?php

session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id= $_GET['user_id'];
$delete = $conn ->query("DELETE FROM user WHERE user_id = '$user_id'");
header("Location: read_user.php");
?>