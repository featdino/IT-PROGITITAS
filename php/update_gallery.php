<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$image_id = $_GET['image_id'];

$result = mysqli_query($conn, "SELECT * FROM gallery WHERE image_id = '$image_id'");
$gallery = mysqli_fetch_assoc($result);

$attractions_result = mysqli_query($conn, "SELECT attraction_id, name FROM attraction ORDER BY name");

$error = '';

if (isset($_POST['submit'])) {
    $is_official   = isset($_POST['is_official']) ? 1 : 0;
    $attraction_id = $_POST['attraction_id'];

    if (!empty($_FILES['image_file']['name'])) {
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
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $filename)) {
                $image_url = 'images/uploads/' . $filename;
            } else {
                $error = 'Upload failed. Check folder permissions on images/uploads/.';
            }
        }
    } else {
        $image_url = $gallery['image_url'];
    }

    if (!$error) {
        $update = "UPDATE gallery SET
                   image_url='$image_url',
                   is_official='$is_official',
                   attraction_id='$attraction_id'
                   WHERE image_id='$image_id'";
        if (mysqli_query($conn, $update)) {
            header("Location: read_gallery.php");
            exit();
        } else {
            $error = 'Database error: ' . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Gallery Image</title>
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

    <main class="monitor-section">
        <div class="monitor-shell">
            <div class="monitor-header">
                <div class="monitor-controls">
                    <a href="read_gallery.php" class="create-btn">Back to Gallery</a>
                </div>
            </div>

            <?php if ($error): ?>
                <p style="color:#8a3d3d; background:#ead7d7; padding:12px 16px; border-radius:14px; margin-bottom:16px;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <input type="checkbox" id="edit-gallery-1" class="edit-modal-toggle" checked>
            <label for="edit-gallery-1" class="edit-modal-backdrop"></label>

            <div class="edit-modal" style="display:block;">
                <a href="read_gallery.php" class="edit-modal-close">&times;</a>

                <div class="edit-modal-header">
                    <h3>Edit Gallery Image</h3>
                    <p>Upload a new file to replace the current image, or just update the settings.</p>
                </div>

                <div style="margin-bottom:20px;">
                    <p style="font-family:'Lora',serif; font-style:italic; color:#5b7440; margin-bottom:8px; font-size:1rem;">Current Image</p>
                    <img src="../<?= htmlspecialchars($gallery['image_url']) ?>"
                         style="height:120px; border-radius:14px; object-fit:cover; display:block;">
                </div>

                <form class="edit-record-form" method="POST" action="" enctype="multipart/form-data">
                    <div class="edit-form-grid">

                        <div class="edit-form-group full-width">
                            <label for="image_file">Replace Image
                                <span style="font-style:normal; font-size:0.85rem; color:#888;">(leave blank to keep current)</span>
                            </label>
                            <input type="file" id="image_file" name="image_file" accept="image/*">
                        </div>

                        <div class="edit-form-group">
                            <label for="attraction_id">Attraction</label>
                            <select id="attraction_id" name="attraction_id" required>
                                <option value="">-- Select Attraction --</option>
                                <?php while ($row = mysqli_fetch_assoc($attractions_result)): ?>
                                    <option value="<?= $row['attraction_id'] ?>"
                                        <?= ($row['attraction_id'] == $gallery['attraction_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="edit-form-group">
                            <label>Official Image?</label>
                            <label class="edit-checkbox-item" style="margin-top:8px;">
                                <span>Mark as official attraction photo</span>
                                <input type="checkbox" name="is_official" value="1"
                                       <?= $gallery['is_official'] ? 'checked' : '' ?>>
                            </label>
                        </div>

                    </div>

                    <div class="edit-form-actions">
                        <a href="read_gallery.php" class="secondary-btn">Cancel</a>
                        <button type="submit" name="submit" class="primary-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
