<?php
    session_start();
    require 'db.php';

    
$categories_query = "SELECT category_id, category, main_class FROM category ORDER BY main_class, category";
$categories_result = mysqli_query($conn, $categories_query);

$selected_category = isset($_GET['category_id'])  ? $_GET['category_id'] : '';


$report_data = [];
$category_name = '';

if (!empty($selected_category)) {
    $cat_query = "SELECT category FROM category WHERE category_id = '$selected_category'";
    $cat_result = mysqli_query($conn, $cat_query);
    $cat_row = mysqli_fetch_assoc($cat_result);
    $category_name = $cat_row['category'];

    $report = "SELECT a.attraction_id, a.name, a.total_visits, a.avg_rating 
                FROM attraction a 
                JOIN attraction_category ac ON a.attraction_id = ac.attraction_id
                WHERE ac.category_id = '$selected_category'
                ORDER BY a.total_visits DESC
                LIMIT 10";

    $report_result = mysqli_query($conn, $report);
    $rank = 1;

        while ($row = mysqli_fetch_assoc($report_result)) {
            $row['rank'] = $rank++;
            $report_data[] = $row;
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Visited Attractions</title>
</head>
<body>
    <h2>Generate Reports</h2>
    <p>View the most visited attractions for the selected category.</p>

    <form method="GET" action="">
        <label>Select Category:</label>
            <select name="category_id">
                <option value="">Choose a category</option>
    </form>
</body>
</html>