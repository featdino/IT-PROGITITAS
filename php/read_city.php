<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = $conn->query("SELECT * FROM city ORDER BY city_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database - Cities</title>
    <link rel="stylesheet" href="../css/admin_base.css" />
    <link rel="stylesheet" href="../css/update_forms.css" />
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
                <a href="read_attraction.php" class="switch-tab">Attractions</a>
                <a href="read_user.php" class="switch-tab">Users</a>
                <a href="read_city.php" class="switch-tab active">Cities</a>
                <a href="read_gallery.php" class="switch-tab">Gallery</a>
                <a href="create_city.php" class="modal-btn" style="margin-left:auto; text-decoration:none;">+ Create City</a>
            </div>

            <div class="report-table-wrap" style="height: calc(100% - 70px);">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>City ID</th>
                            <th>City Name</th>
                            <th>Province</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $read->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['city_id']) ?></td>
                                <td><?= htmlspecialchars($row['city_name']) ?></td>
                                <td><?= htmlspecialchars($row['province']) ?></td>
                                <td>
                                    <a href="update_city.php?city_id=<?= $row['city_id'] ?>" class="modal-btn update-btn" style="padding:10px 16px; text-decoration:none;">Update</a>
                                    <a href="delete_city.php?city_id=<?= $row['city_id'] ?>" class="modal-btn delete-btn" style="padding:10px 16px; text-decoration:none;" onclick="return confirm('Are you sure you want to delete this city?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
