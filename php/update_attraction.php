<?php
session_start();
require 'db.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$cities_result = mysqli_query($conn, "SELECT city_id, city_name FROM city ORDER BY city_name");

$attraction_id = $_GET['attraction_id'];
$read = $conn->query("SELECT name, description, street_address, city_id FROM attraction WHERE attraction_id = $attraction_id")->fetch_assoc();

$categories_result = mysqli_query($conn, "SELECT category_id, category, main_class FROM category ORDER BY main_class, category");
$current_categories = [];
$cat_result = $conn->query("SELECT category_id FROM attraction_category WHERE attraction_id = $attraction_id");
while ($cat_row = $cat_result->fetch_assoc()) {
    $current_categories[] = $cat_row['category_id'];
}

// Fetch gallery images for this attraction
$gallery_result = $conn->query("SELECT * FROM gallery WHERE attraction_id = $attraction_id ORDER BY is_official DESC, image_id");

$error = '';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save_attraction'])) {
    $name         = $_POST['name'];
    $description  = $_POST['description'];
    $street_address = $_POST['street_address'];
    $city_id      = $_POST['city_id'];
    $categories   = isset($_POST['categories']) ? $_POST['categories'] : [];

    // total_visits, avg_rating, local_rating, gem_score are READ-ONLY — not touched here
    $update = $conn->prepare("UPDATE attraction SET name=?, description=?, street_address=?, city_id=? WHERE attraction_id=?");
    $update->bind_param("sssii", $name, $description, $street_address, $city_id, $attraction_id);

    if ($update->execute()) {
        $conn->query("DELETE FROM attraction_category WHERE attraction_id='$attraction_id'");
        foreach ($categories as $category_id) {
            $conn->query("INSERT INTO attraction_category (attraction_id, category_id) VALUES ('$attraction_id', '$category_id')");
        }
        header("Location: attraction_details.php?attraction_id=$attraction_id");
        exit();
    } else {
        $error = "Error updating attraction: " . $conn->error;
    }
    $update->close();
}

// Handle gallery image upload from this page
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_image'])) {
    $is_official  = isset($_POST['is_official']) ? 1 : 0;
    $admin_user_id = $_SESSION['user_id'] ?? 1;

    if (empty($_FILES['image_file']['name'])) {
        $error = 'Please select an image file.';
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
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $filename)) {
                $image_url = 'images/uploads/' . $filename;
                $conn->query("INSERT INTO gallery (image_url, is_official, attraction_id, user_id)
                              VALUES ('$image_url', '$is_official', '$attraction_id', '$admin_user_id')");
                header("Location: update_attraction.php?attraction_id=$attraction_id");
                exit();
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
    <title>Update Attraction</title>
    <link rel="stylesheet" href="../css/database_monitor.css">
    <style>
        /* Gallery strip inside the update modal */
        .gallery-strip {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        .gallery-thumb {
            position: relative;
            width: 100px;
            height: 72px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .gallery-thumb .official-badge {
            position: absolute;
            top: 4px;
            left: 4px;
            background: #3e622f;
            color: #fff;
            font-size: 0.65rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 6px;
        }
        .gallery-thumb .delete-thumb {
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(138,61,61,0.85);
            color: #fff;
            border: none;
            border-radius: 6px;
            width: 20px;
            height: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            line-height: 1;
        }
        .gallery-empty {
            color: #888;
            font-style: italic;
            font-size: 0.95rem;
            padding: 8px 0;
        }
        .section-divider {
            border: none;
            border-top: 1px solid #d8d2c8;
            margin: 24px 0;
        }
    </style>
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
                    <h2>Update Attraction</h2>
                    <p>Edit attraction details and manage its gallery images.</p>
                </div>
                <div class="monitor-controls">
                    <a href="attraction_details.php?attraction_id=<?= $attraction_id ?>" class="create-btn">Back to Details</a>
                </div>
            </div>

            <?php if ($error): ?>
                <p style="color:#8a3d3d; background:#ead7d7; padding:12px 16px; border-radius:14px; margin-bottom:16px;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <input type="checkbox" id="edit-attraction-1" class="edit-modal-toggle" checked>
            <label for="edit-attraction-1" class="edit-modal-backdrop"></label>

            <div class="edit-modal" style="display:block; max-height:85vh;">
                <a href="attraction_details.php?attraction_id=<?= $attraction_id ?>" class="edit-modal-close">&times;</a>

                <!-- ============ ATTRACTION DETAILS FORM ============ -->
                <div class="edit-modal-header">
                    <h3>Attraction Details</h3>
                    <p>Name, location, description, and categories.</p>
                </div>

                <form class="edit-record-form" method="POST" action="">
                    <input type="hidden" name="save_attraction" value="1">
                    <div class="edit-form-grid">

                        <div class="edit-form-group">
                            <label for="edit-name">Attraction Name</label>
                            <input type="text" id="edit-name" name="name"
                                   value="<?= htmlspecialchars($read['name']) ?>" required>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-city">City</label>
                            <select id="edit-city" name="city_id" required>
                                <option value="">-- Select City --</option>
                                <?php while ($row = mysqli_fetch_assoc($cities_result)): ?>
                                    <option value="<?= $row['city_id'] ?>"
                                        <?= ($row['city_id'] == $read['city_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['city_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="edit-form-group full-width">
                            <label for="edit-address">Street Address</label>
                            <input type="text" id="edit-address" name="street_address"
                                   value="<?= htmlspecialchars($read['street_address']) ?>" required>
                        </div>

                        <div class="edit-form-group full-width">
                            <label for="edit-description">Description</label>
                            <textarea id="edit-description" name="description" rows="4" required><?= htmlspecialchars($read['description']) ?></textarea>
                        </div>

                        <div class="edit-form-group full-width">
                            <p class="edit-form-label">Categories</p>
                            <div class="edit-checkbox-group">
                                <?php
                                mysqli_data_seek($categories_result, 0);
                                while ($category = mysqli_fetch_assoc($categories_result)):
                                    $checked = in_array($category['category_id'], $current_categories) ? 'checked' : '';
                                ?>
                                    <label class="edit-checkbox-item">
                                        <span><?= htmlspecialchars($category['category']) ?></span>
                                        <input type="checkbox" name="categories[]"
                                               value="<?= $category['category_id'] ?>" <?= $checked ?>>
                                    </label>
                                <?php endwhile; ?>
                            </div>
                        </div>

                    </div>

                    <div class="edit-form-actions">
                        <a href="attraction_details.php?attraction_id=<?= $attraction_id ?>" class="secondary-btn">Cancel</a>
                        <button type="submit" class="primary-btn">Save Changes</button>
                    </div>
                </form>

                <hr class="section-divider">

                <!-- ============ GALLERY SECTION ============ -->
                <div class="edit-modal-header">
                    <h3>Gallery Images</h3>
                    <p>Current images for this attraction. The one marked Official shows on cards.</p>
                </div>

                <!-- Existing images strip -->
                <?php
                $gallery_images = [];
                while ($g = $gallery_result->fetch_assoc()) $gallery_images[] = $g;
                ?>

                <?php if (empty($gallery_images)): ?>
                    <p class="gallery-empty">No images uploaded yet.</p>
                <?php else: ?>
                    <div class="gallery-strip">
                        <?php foreach ($gallery_images as $g): ?>
                            <div class="gallery-thumb">
                                <img src="../<?= htmlspecialchars($g['image_url']) ?>" alt="gallery image">
                                <?php if ($g['is_official']): ?>
                                    <span class="official-badge">Official</span>
                                <?php endif; ?>
                                <a href="delete_gallery.php?image_id=<?= $g['image_id'] ?>&redirect=update_attraction&attraction_id=<?= $attraction_id ?>"
                                   class="delete-thumb"
                                   onclick="return confirm('Delete this image?')"
                                   title="Delete">×</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Upload new image -->
                <form method="POST" action="" enctype="multipart/form-data" style="margin-top:20px;">
                    <input type="hidden" name="add_image" value="1">
                    <div class="edit-form-grid">

                        <div class="edit-form-group full-width">
                            <label for="image_file">Upload New Image</label>
                            <input type="file" id="image_file" name="image_file" accept="image/*">
                        </div>

                        <div class="edit-form-group">
                            <label>Official Image?</label>
                            <label class="edit-checkbox-item" style="margin-top:8px;">
                                <span>Mark as official attraction photo</span>
                                <input type="checkbox" name="is_official" value="1">
                            </label>
                        </div>

                    </div>

                    <div class="edit-form-actions">
                        <button type="submit" class="primary-btn">Upload Image</button>
                    </div>
                </form>

            </div><!-- /edit-modal -->
        </div>
    </main>
</body>
</html>
