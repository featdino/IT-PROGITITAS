<!-- paste the search html code after php code if done -->

<?php
session_start(); 
require 'db.php'; 

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$searchResults = [];

if ($query !== '') {
    // get each keyword separated by a space from the search query 
    $keywords = explode(" ", $query);

    // add a condition to search for each keyword in the attraction's name and description
    $conditions = [];
    foreach ($keywords as $word) {
        $word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "(name LIKE '%$word%' OR description LIKE '%$word%')";
    }

    // combine each condition with AND to ensure all keywords are present in the results
    $sql = "SELECT * FROM attraction WHERE " . implode(" AND ", $conditions);
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }
}

$pageTitle = "Search";
$pageStyle = "search.css";
include('header.php'); 
?>
