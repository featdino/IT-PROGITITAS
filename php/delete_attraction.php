<?php

session_start(); 
require 'db.php'; 


$attraction_id = $_GET['attraction_id'];

$delete_visits = $conn->query("DELETE FROM visits WHERE attraction_id= '$attraction_id'");
$delete = $conn->query("DELETE FROM attraction WHERE attraction_id = '$attraction_id'");

header("Location: read_attraction.php");
exit();

?>