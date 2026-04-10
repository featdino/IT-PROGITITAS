<!-- this is the page of attraction listings, after search input and/or category filters -->

<?php

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

$conditions = [];
if ($query !== '') {
    $keywords = explode(" ", $query);
    foreach ($keywords as $word) {
        $word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "(a.name LIKE '%$word%' OR a.description LIKE '%$word%')";
    }
}

$sql = "SELECT a.* 
        FROM attraction a";

if ($category_id > 0) {
    $sql .= " 
        JOIN attraction_category ac ON a.attraction_id = ac.attraction_id
        WHERE ac.category_id = $category_id";
    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }
} else if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY a.gem_score DESC";

?>