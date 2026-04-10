<!-- logic behind ratings -->
<?php
session_start();
require 'db.php';

// only allow logged in users with "user" role to submit ratings
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$attraction_id = $_POST['attraction_id'];
$rating = $_POST['rating'];

// only allow rating if visited
$query = "SELECT * FROM visits WHERE user_id='$user_id' AND attraction_id='$attraction_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("You must visit first.");
}

// insert new rating if user never rated before, otherwise update existing rating
mysqli_query($conn, "
    INSERT INTO ratings (user_id, attraction_id, rating)
    VALUES ('$user_id', '$attraction_id', '$rating')
    ON DUPLICATE KEY UPDATE rating = '$rating'
");

// overall avg rating (including visitor and local ratings) 
$avg_result = mysqli_query($conn, "
    SELECT AVG(rating) AS avg_rating
    FROM ratings
    WHERE attraction_id = '$attraction_id'
");

$avg_row = mysqli_fetch_assoc($avg_result);
$avg_rating = $avg_row['avg_rating'] ?? 0;

// local rating and local count (users whose city matches attraction's city)
$local_result = mysqli_query($conn, "
    SELECT AVG(r.rating) AS local_avg, COUNT(*) AS local_count
    FROM ratings r
    JOIN user u ON r.user_id = u.user_id
    JOIN attraction a ON r.attraction_id = a.attraction_id
    WHERE r.attraction_id = '$attraction_id'
    AND u.city_id = a.city_id
");

$local_row = mysqli_fetch_assoc($local_result);
$local_rating = $local_row['local_avg'] ?? 0;
$local_count = $local_row['local_count'] ?? 0;

// non-local/tourist visits (count of visits from users whose city does NOT match attraction's city)
$non_local_result = mysqli_query($conn, "
    SELECT COUNT(*) AS non_local_visits
    FROM visits v
    JOIN user u ON v.user_id = u.user_id
    JOIN attraction a ON v.attraction_id = a.attraction_id
    WHERE v.attraction_id = '$attraction_id'
    AND u.city_id != a.city_id
");

$non_local_row = mysqli_fetch_assoc($non_local_result);
$non_local_visits = $non_local_row['non_local_visits'] ?? 0;

// gem score calculation: high local rating and low non-local visits = high gem score (hidden gem)
// while low local rating and high non-local visits = low gem score (touristy spot)
// however there should be atleast 5 high local ratings so that gem score won't be inflated even with just 1 or 2 high local ratings
if ($local_count < 5) {
    $gem_score = 0;
} else {
    $gem_score = ((1 / ($non_local_visits + 1)) * 0.6) + ($local_rating * 0.4);
}

// update attraction data
mysqli_query($conn, "
    UPDATE attraction 
    SET 
        avg_rating = '$avg_rating',
        local_rating = '$local_rating',
        gem_score = '$gem_score'
    WHERE attraction_id = '$attraction_id'
");

// redirect back
header("Location: attraction.php?id=" . $attraction_id);
exit();
?>