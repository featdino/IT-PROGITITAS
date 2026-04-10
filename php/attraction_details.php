<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$attraction_id = $_GET['attraction_id'];

$detail_query = "SELECT a.*, c.city_name, c.province 
                 FROM attraction a 
                 LEFT JOIN city c ON a.city_id = c.city_id 
                 WHERE a.attraction_id = '$attraction_id'";
$detail_result = $conn->query($detail_query);
$attraction = $detail_result->fetch_assoc();

$cat_query = "SELECT cat.category, cat.main_class 
              FROM category cat
              JOIN attraction_category ac ON cat.category_id = ac.category_id
              WHERE ac.attraction_id = '$attraction_id'";
$cat_result = $conn->query($cat_query);
$categories_list = [];
while ($cat = $cat_result->fetch_assoc()) {
    $categories_list[] = htmlspecialchars($cat['category']);
}

$img_query = "SELECT image_url FROM gallery 
              WHERE attraction_id = '$attraction_id' AND is_official = 1 
              LIMIT 1";
$img_result = $conn->query($img_query);
$official_image = $img_result ? $img_result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($attraction['name']) ?> - Details</title>
    <link rel="stylesheet" href="../css/admin_base.css" />
    <link rel="stylesheet" href="../css/read_attraction.css" />
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

    <input type="checkbox" id="modal-card-1" class="modal-toggle" checked>

    <div class="dashboard-section">
        <div class="dashboard-tabs">
            <a href="read_attraction.php" class="tab active">View Database</a>
            <a href="generate_report.php" class="tab">Generate Reports</a>
        </div>

        <div class="dashboard-shell">
            <div class="database-switch-tabs">
                <a href="read_attraction.php" class="switch-tab active">Attractions</a>
                <a href="read_user.php" class="switch-tab">Users</a>
                <a href="read_city.php" class="switch-tab">Cities</a>
                <a href="create_attraction.php" class="modal-btn" style="margin-left:auto; text-decoration:none;">+ Create Attraction</a>
            </div>
        </div>
    </div>

    <label for="modal-card-1" class="modal-backdrop"></label>

    <div class="details-modal">
        <a href="read_attraction.php" class="modal-close" aria-label="Close modal">&times;</a>

        <div class="modal-left">
            <div class="modal-image">
                <?php if ($official_image && $official_image['image_url']): ?>
                    <img src="../<?= htmlspecialchars($official_image['image_url']) ?>" alt="<?= htmlspecialchars($attraction['name']) ?>">
                <?php else: ?>
                    <img src="../images/attraction-1.jpg" alt="<?= htmlspecialchars($attraction['name']) ?>">
                <?php endif; ?>
            </div>

            <h2><?= htmlspecialchars($attraction['name']) ?></h2>

            <div class="modal-info-block">
                <h4>ID</h4>
                <p><?= htmlspecialchars($attraction['attraction_id']) ?></p>
            </div>

            <div class="modal-info-block">
                <h4>Street Address</h4>
                <p><?= htmlspecialchars($attraction['street_address']) ?></p>
            </div>

            <div class="modal-info-block">
                <h4>City</h4>
                <p><?= htmlspecialchars($attraction['city_name'] ?? 'N/A') ?><?= $attraction['province'] ? ', ' . htmlspecialchars($attraction['province']) : '' ?></p>
            </div>

            <div class="modal-actions">
                <a href="update_attraction.php?attraction_id=<?= $attraction['attraction_id'] ?>" class="modal-btn update-btn" style="text-decoration:none;">
                    Update
                </a>

                <a href="delete_attraction.php?attraction_id=<?= $attraction['attraction_id'] ?>" 
                   class="modal-btn delete-btn"
                   onclick="return confirm('Are you sure you want to delete this attraction?')"
                   style="text-decoration:none;">
                    Delete
                </a>
            </div>
        </div>

        <div class="modal-divider"></div>

        <div class="modal-right">
            <div class="modal-info-block">
                <h3>Description</h3>
                <p><?= htmlspecialchars($attraction['description'] ?? 'No description available.') ?></p>
            </div>

            <div class="modal-info-block">
                <h3>Categories</h3>
                <p><?= !empty($categories_list) ? implode(', ', $categories_list) : 'None assigned' ?></p>
            </div>

            <div class="modal-info-block">
                <h3>Total Visits</h3>
                <p><?= number_format($attraction['total_visits']) ?></p>
            </div>

            <div class="modal-info-block">
                <h3>Average Rating</h3>
                <p><?= htmlspecialchars($attraction['avg_rating'] ?? 'N/A') ?></p>
            </div>

            <div class="modal-info-block">
                <h3>Local Rating</h3>
                <p><?= htmlspecialchars($attraction['local_rating'] ?? 'N/A') ?></p>
            </div>

            <div class="modal-info-block">
                <h3>Gem Score</h3>
                <p><?= htmlspecialchars($attraction['gem_score'] ?? 'N/A') ?></p>
            </div>
        </div>
    </div>
</body>
</html>