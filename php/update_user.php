<?php
session_start(); 
require 'db.php'; 

/*if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}*/

$cities_query = "SELECT city_id, city_name FROM city ORDER BY city_name";
$cities_result = mysqli_query($conn, $cities_query);

$user_id = $_GET['user_id'];
$read = $conn->query("SELECT name, username, password, email, city_id, role FROM user WHERE user_id = $user_id")->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $city_id = $_POST['city_id'];
    $role = $_POST['role'];

    if (!empty(trim($_POST['password']))) {
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE user SET name=?, username=?, password=?, email=?, city_id=?, role=? WHERE user_id=?");
        $update->bind_param("ssssssi", $name, $username, $password, $email, $city_id, $role, $user_id);
    } else {
        $update = $conn->prepare("UPDATE user SET name=?, username=?, email=?, city_id=?, role=? WHERE user_id=?");
        $update->bind_param("sssssi", $name, $username, $email, $city_id, $role, $user_id);
    }

    if ($update->execute()) {
        header("Location: read_user.php");
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
    <title>Update User</title>
    <link rel="stylesheet" href="../css/admin_base.css" />
    <link rel="stylesheet" href="../css/read_user.css" />
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
                    <h2>Update User</h2>
                    <p>Update the selected user record.</p>
                </div>
                <div class="monitor-controls">
                    <a href="read_user.php" class="create-btn">Back to Users</a>
                </div>
            </div>

            <?php if (isset($error)): ?>
                <p style="color:red; margin-bottom:16px;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <input type="checkbox" id="edit-user-1" class="edit-modal-toggle" checked>
            <label for="edit-user-1" class="edit-modal-backdrop"></label>

            <div class="edit-modal" style="display:grid;">
                <a href="read_user.php" class="edit-modal-close" aria-label="Back">&times;</a>
                <div class="edit-modal-header">
                    <h3>Edit User</h3>
                    <p>Update the selected user record.</p>
                </div>

                <form class="edit-record-form" method="POST" action="">
                    <div class="edit-form-grid">
                        <div class="edit-form-group">
                            <label for="edit-name">Full Name</label>
                            <input type="text" id="edit-name" name="name" value="<?= htmlspecialchars($read['name']) ?>" required>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-username">Username</label>
                            <input type="text" id="edit-username" name="username" value="<?= htmlspecialchars($read['username']) ?>" required>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" id="edit-email" name="email" value="<?= htmlspecialchars($read['email']) ?>" required>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-city">City</label>
                            <select id="edit-city" name="city_id">
                                <option value="">-- Select City --</option>
                                <?php while ($row = mysqli_fetch_assoc($cities_result)): ?>
                                    <option value="<?= $row['city_id'] ?>" <?= ($row['city_id'] == $read['city_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['city_name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-role">Role</label>
                            <select id="edit-role" name="role">
                                <option value="user" <?= ($read['role'] == 'user') ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= ($read['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>

                        <div class="edit-form-group">
                            <label for="edit-password">New Password <span style="font-style:normal; font-size:0.85rem; color:#888;">(leave blank to keep current)</span></label>
                            <input type="password" id="edit-password" name="password" placeholder="Enter new password">
                        </div>
                    </div>

                    <div class="edit-form-actions">
                        <a href="read_user.php" class="secondary-btn">Back</a>
                        <button type="submit" name="submit" class="primary-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
