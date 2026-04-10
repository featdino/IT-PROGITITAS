<!-- this is the page of attraction listings, after search input and/or category filters -->
<?php
session_start();
require 'db.php';

$query       = isset($_GET['query']) ? trim($_GET['query']) : '';
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
$city        = isset($_GET['city_id']) ? $_GET['city_id'] : 0;
$topRated    = isset($_GET['top_rated']) ? true : false;

$conditions = [];

// add conditions if user searched for something
if ($query !== '') {
    // split keywords by space and find them from attraction names or descriptions
    $keywords = explode(" ", $query);
    foreach ($keywords as $word) {
        $word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "(a.name LIKE '%$word%' OR a.description LIKE '%$word%')";
    }
}

$sql = "SELECT a.* FROM attraction a";

// add conditions based on search, category, city, and top rated filters

if ($category_id > 0) {
    $sql .= " JOIN attraction_category ac ON a.attraction_id = ac.attraction_id
              WHERE ac.category_id = $category_id";
    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }
} 
else if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions); // apply the conditions from search query
} 
else {
    $sql .= " WHERE 1=1"; // this is if no conditions were provided via search keywords/category filters
}

if ($city_id > 0) {
    $sql .= " AND a.city_id = $city_id";
}

if ($topRated) {
    $sql .= " AND a.gem_score >= 4.0"; // threshold for "hidden gems"
}

$sql .= " ORDER BY a.gem_score DESC";

$result = mysqli_query($conn, $sql);
?>