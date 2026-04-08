<!-- paste the search html code after php code if done -->

<?php
session_start(); 
require 'db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$results = [];

if ($query !== '') {
    // get each keyword separated by a space from the search query 
    $keywords = explode(" ", $query);

    $sql = "SELECT * FROM attraction WHERE ";
    $conditions = [];
    $params = [];
    $types = "";

    // add a condition to search for each keyword in the attraction's name and description 
    foreach ($keywords as $word) {
        $conditions[] = "(name LIKE ? OR description LIKE ?)";
        $params[] = "%$word%";
        $params[] = "%$word%";
        $types .= "ss"; // data type for each placeholder, both name and description are strings (s)
    }

    // combine each condition with AND to ensure all keywords are present in the results
    $sql .= implode(" AND ", $conditions);

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
}
?>