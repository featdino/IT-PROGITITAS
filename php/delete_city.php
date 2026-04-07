<?php

session_start(); 
require 'db.php'; 

$city_id = $_GET['city_id'];

$nullify_user = $conn->query("UPDATE user SET city_id = NULL WHERE city_id = '$city_id'");
$delete = $conn->query("DELETE FROM city WHERE city_id = '$city_id'");
header("Location: read_city.php");
exit();
?>