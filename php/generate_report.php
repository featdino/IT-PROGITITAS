<?php
    session_start();
    require 'db.php';
    
if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
    
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
            <?php while($cat = mysqli_fetch_assoc($categories_result)): ?>
                <option value="<?= $cat['category_id'] ?>" <?= ($selected_category == $cat['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['category']) ?> (<?= htmlspecialchars($cat['main_class']) ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Generate</button>
    </form>
    <br>

    <?php if(!empty($selected_category)): ?>
        <?php if(empty($report_data)): ?>
            <p>No attraction found under this category</p>
        <?php else: ?>
            <h3>Top 10 Most Visited Attractions - <?= htmlspecialchars($category_name) ?></h3>
            <table>
                <tr>
                    <th>Rank</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Visits</th>
                    <th>Average Rating</th>
                </tr>
                <?php foreach($report_data as $item): ?>
                <tr>
                    <td><?= $item['rank'] ?></td>
                    <td><?= $item['attraction_id'] ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['total_visits']) ?></td>
                    <td><?= $item['avg_rating'] ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>
    </body>
</html>