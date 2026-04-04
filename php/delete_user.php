<?php

session_start(); 
require 'db.php'; 

$user_id= $_SESSION['user_id'];
$delete = $conn ->query("DELETE * FROM user WHERE user_id = 'user_id'");
header("Location: read_user.php");
?>