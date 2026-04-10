<?php
session_start(); 
require 'db.php'; 

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$city_id = $_GET['city_id'];
$read = $conn->query("SELECT city_name, province FROM city WHERE city_id = $city_id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $city_name = $_POST['city_name'];
    $province = $_POST['province'];

    $update = $conn->prepare("UPDATE city SET city_name=?, province=? WHERE city_id=?");
    $update->bind_param("ssi", $city_name, $province, $city_id);
    if ($update->execute()) {
        header("Location: read_city.php");
        exit();
    } else {
        $error = "Error updating record: " . $conn->error;
    }
    $update->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update City</title>
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

    <main class="monitor-section">
        <div class="monitor-shell">
            <div class="monitor-header">
                <div>
                    <h2>Update City</h2>
                    <p>Update the selected city record.</p>
                </div>
                <div class="monitor-controls">
                    <a href="read_city.php" class="create-btn">Back to Cities</a>
                </div>
            </div>

            <?php if (isset($error)): ?>
                <p style="color:red; margin-bottom:16px;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <input type="checkbox" id="edit-city-1" class="edit-modal-toggle" checked>
            <label for="edit-city-1" class="edit-modal-backdrop"></label>

            <div class="edit-modal" style="display:grid;">
                <a href="read_city.php" class="edit-modal-close" aria-label="Back">&times;</a>
                <div class="edit-modal-header">
                    <h3>Edit City</h3>
                    <p>Update the selected city record.</p>
                </div>

                <form class="edit-record-form" method="POST" action="">
                    <div class="edit-form-grid">
                        <div class="edit-form-group">
                            <label for="edit-city-name">City Name</label>
                            <input type="text" id="edit-city-name" name="city_name" value="<?= htmlspecialchars($read['city_name']) ?>" required>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-province">Province</label>
                            <input type="text" id="edit-province" name="province" value="<?= htmlspecialchars($read['province']) ?>" required>
                        </div>
                    </div>

                    <div class="edit-form-actions">
                        <a href="read_city.php" class="secondary-btn">Back</a>
                        <button type="submit" class="primary-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
