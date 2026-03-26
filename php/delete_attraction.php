<?php

session_start(); 
require 'db.php'; 
if (!isset($_SESSION['attraction_id'])) { 
header("Location: admin.php"); // assuming this is the default page ng admin
exit(); 
}

$attraction_id = $_GET['attraction_id'];
$delete = $conn->query("DELETE * FROM attraction WHERE attraction_id = '$attraction_id'");
header("Location: read.php");

?>