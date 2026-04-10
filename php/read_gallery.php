<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$read = "SELECT g.*, a.name AS attraction_name, u.name AS user_name
         FROM gallery g
         LEFT JOIN attraction a ON g.attraction_id = a.attraction_id
         LEFT JOIN user u ON g.user_id = u.user_id
         ORDER BY g.attraction_id, g.is_official DESC, g.image_id";
$result = mysqli_query($conn, $read);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database - Gallery</title>
    <link rel="stylesheet" href="../css/admin_base.css">
    <link rel="stylesheet" href="../css/update_forms.css">
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
                <a href="read_city.php" class="switch-tab">Cities</a>
                <a href="read_gallery.php" class="switch-tab active">Gallery</a>
                <a href="create_gallery.php" class="modal-btn" style="margin-left:auto; text-decoration:none;">+ Add Image</a>
            </div>

            <div class="report-table-wrap" style="height: calc(100% - 70px);">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Attraction</th>
                            <th>Uploaded By</th>
                            <th>Official</th>
                            <th>Upload Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['image_id']) ?></td>
                                <td>
                                    <img src="../<?= htmlspecialchars($row['image_url']) ?>"
                                         style="width:72px; height:52px; object-fit:cover; border-radius:10px; display:block;">
                                </td>
                                <td><?= htmlspecialchars($row['attraction_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($row['user_name'] ?? 'N/A') ?></td>
                                <td><?= $row['is_official'] ? '✓ Yes' : 'No' ?></td>
                                <td><?= htmlspecialchars($row['upload_date'] ?? '') ?></td>
                                <td>
                                    <a href="update_gallery.php?image_id=<?= $row['image_id'] ?>"
                                       class="modal-btn update-btn" style="padding:8px 14px; text-decoration:none;">Update</a>
                                    <a href="delete_gallery.php?image_id=<?= $row['image_id'] ?>"
                                       class="modal-btn delete-btn" style="padding:8px 14px; text-decoration:none;"
                                       onclick="return confirm('Delete this image?')">Delete</a>
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
