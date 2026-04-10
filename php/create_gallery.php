<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$admin_user_id = $_SESSION['user_id'] ?? 1;

$attractions_result = mysqli_query($conn, "SELECT attraction_id, name FROM attraction ORDER BY name");

$error = '';

if (isset($_POST['submit'])) {
    $is_official  = isset($_POST['is_official']) ? 1 : 0;
    $attraction_id = $_POST['attraction_id'];

    if (empty($_FILES['image_file']['name'])) {
        $error = 'Please select an image file to upload.';
    } else {
        $upload_dir = '../images/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $error = 'Only JPG, PNG, and WEBP files are allowed.';
        } elseif ($_FILES['image_file']['size'] > 5 * 1024 * 1024) {
            $error = 'File must be under 5MB.';
        } else {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['image_file']['name']));
            $target   = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target)) {
                $image_url = 'images/uploads/' . $filename;
                $insert = "INSERT INTO gallery (image_url, is_official, attraction_id, user_id)
                           VALUES ('$image_url', '$is_official', '$attraction_id', '$admin_user_id')";
                if (mysqli_query($conn, $insert)) {
                    header("Location: read_gallery.php");
                    exit();
                } else {
                    $error = 'Database error: ' . mysqli_error($conn);
                }
            } else {
                $error = 'Upload failed. Check folder permissions on images/uploads/.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gallery Image</title>
    <link rel="stylesheet" href="../css/admin_base.css">
    <link rel="stylesheet" href="../css/create_record.css">
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
        <a href="create_gallery.php">Add Image</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main class="create-section">
        <div class="create-shell">
            <div class="create-header">
                <h2>Add Gallery Image</h2>
                <p>Upload a new image for an attraction.</p>
            </div>

            <div class="record-switch-tabs">
                <a href="create_attraction.php" class="switch-tab">Attraction</a>
                <a href="create_user.php" class="switch-tab">User</a>
                <a href="create_city.php" class="switch-tab">City</a>
                <a href="create_gallery.php" class="switch-tab active">Gallery</a>
            </div>

            <?php if ($error): ?>
                <p style="color:#8a3d3d; background:#ead7d7; padding:12px 16px; border-radius:14px; margin-bottom:16px;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <section class="record-panel" style="display:block; height:100%;">
                <form class="record-form" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-grid">

                        <div class="form-group full-width">
                            <label for="image_file">Image File</label>
                            <input type="file" id="image_file" name="image_file" accept="image/*" required>
                        </div>

                        <div class="form-group">
                            <label for="attraction_id">Attraction</label>
                            <select id="attraction_id" name="attraction_id" required>
                                <option value="">-- Select Attraction --</option>
                                <?php while ($row = mysqli_fetch_assoc($attractions_result)): ?>
                                    <option value="<?= $row['attraction_id'] ?>">
                                        <?= htmlspecialchars($row['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Official Image?</label>
                            <label class="checkbox-item" style="margin-top:8px;">
                                <span>Mark as official attraction photo</span>
                                <input type="checkbox" name="is_official" value="1">
                            </label>
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="read_gallery.php" class="primary-btn"
                           style="margin-right:10px; text-decoration:none; background:#ece6dc; color:#4b4f73;">Cancel</a>
                        <button type="submit" name="submit" class="primary-btn">Upload Image</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
