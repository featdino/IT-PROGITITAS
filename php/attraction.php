<!-- this is the page for each attraction's information and views -->

<?php
session_start(); 
require 'db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>