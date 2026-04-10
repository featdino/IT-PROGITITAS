<?php
require 'db.php';

// Fetch all users
$result = mysqli_query($conn, "SELECT user_id, password FROM user");

while ($row = mysqli_fetch_assoc($result)) {
    $userId = $row['user_id'];
    $plainPassword = $row['password'];

    // Skip if already hashed (bcrypt hashes start with $2y$)
    if (strpos($plainPassword, '$2y$') === 0) {
        continue;
    }

    // Hash the existing plain text password
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Update the database with the hashed password
    mysqli_query($conn, "UPDATE user SET password='" . mysqli_real_escape_string($conn, $hashedPassword) . "' WHERE user_id=$userId");
}

echo "Passwords migrated successfully!";
?>
