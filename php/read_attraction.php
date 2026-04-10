<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = $conn->query("SELECT * FROM attraction");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Off-Radar Admin Dashboard</title>
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
                <a href="read_gallery.php" class="switch-tab">Gallery</a>
                <a href="create_attraction.php" class="modal-btn" style="margin-left:auto; text-decoration:none;">+ Create Attraction</a>
            </div>

            <section class="database-view" style="display:block;">
                <div class="card-board">
                    <?php while ($row = $read->fetch_assoc()):
                        $img_query = "SELECT image_url FROM gallery
                                      WHERE attraction_id = '{$row['attraction_id']}'
                                      ORDER BY is_official DESC
                                      LIMIT 1";
                        $img_result = $conn->query($img_query);
                        $image = $img_result ? $img_result->fetch_assoc() : null;
                    ?>
                        <a href="attraction_details.php?attraction_id=<?= $row['attraction_id'] ?>" class="attraction-card">
                            <div class="card-image">
                                <?php if ($image && $image['image_url']): ?>
                                    <img src="../<?= htmlspecialchars($image['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                <?php else: ?>
                                    <img src="../images/attraction-1.jpg" alt="<?= htmlspecialchars($row['name']) ?>">
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <h2><?= htmlspecialchars($row['name']) ?></h2>
                                <p class="id">ID <?= htmlspecialchars($row['attraction_id']) ?></p>
                            </div>
                            <span class="card-corner-btn" aria-hidden="true">
                                <span></span><span></span><span></span>
                            </span>
                        </a>
                    <?php endwhile; ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
