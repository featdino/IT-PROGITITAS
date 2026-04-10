<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$categories_query = "SELECT category_id, category, main_class FROM category ORDER BY main_class, category";
$categories_result = mysqli_query($conn, $categories_query);

$selected_category = isset($_GET['category_id']) ? $_GET['category_id'] : '';

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
    <title>Generate Reports</title>
    <link rel="stylesheet" href="../css/admin_base.css" />
    <link rel="stylesheet" href="../css/generate_report.css" />
</head>
<body>
    <div class="page-overlay"></div>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="menu-backdrop"></label>

    <header class="topbar">
        <div class="brand">
            <div class="logo-circle">
                <img src="../images/logo-icon.png" alt="Off-Radar logo" />
            </div>
            <h1>off-radar.</h1>
        </div>
        <div class="top-actions">
            <label for="menu-toggle" class="menu-btn" aria-label="Open menu">
                <span></span><span></span><span></span>
            </label>
        </div>
    </header>

    <nav class="side-menu">
        <a href="read_attraction.php">Dashboard</a>
        <a href="read_attraction.php">View Database</a>
        <a href="generate_report.php">Generate Reports</a>
        <a href="create_attraction.php">Create Attraction</a>
        <a href="create_user.php">Create User</a>
        <a href="create_city.php">Create City</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="dashboard-section">
        <div class="dashboard-tabs">
            <a href="read_attraction.php" class="tab">View Database</a>
            <a href="generate_report.php" class="tab active">Generate Reports</a>
        </div>

        <div class="dashboard-shell">
            <section class="reports-view" style="display:block;">
                <div class="reports-panel">
                    <div class="reports-header">
                        <h2>Generate Reports</h2>
                        <p>View the most visited attractions for the selected category.</p>
                    </div>

                    <div class="report-controls">
                        <form method="GET" action="" style="display:contents;">
                            <div class="report-field">
                                <label for="category_id">Select Category</label>
                                <select id="category_id" name="category_id">
                                    <option value="">Choose a category</option>
                                    <?php while ($cat = mysqli_fetch_assoc($categories_result)): ?>
                                        <option value="<?= $cat['category_id'] ?>" <?= ($selected_category == $cat['category_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['category']) ?> (<?= htmlspecialchars($cat['main_class']) ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <button type="submit" class="report-generate-btn">Generate</button>
                        </form>
                    </div>

                    <div class="report-table-wrap">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total Visits</th>
                                    <th>Average Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($selected_category)): ?>
                                    <?php if (empty($report_data)): ?>
                                        <tr><td colspan="5" style="text-align:center; padding:24px; color:#888;">No attractions found under this category.</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($report_data as $item): ?>
                                            <tr>
                                                <td><?= $item['rank'] ?></td>
                                                <td><?= htmlspecialchars($item['attraction_id']) ?></td>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= htmlspecialchars($item['total_visits']) ?></td>
                                                <td><?= htmlspecialchars($item['avg_rating']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" style="text-align:center; padding:24px; color:#888;">Select a category and click Generate to view results.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
