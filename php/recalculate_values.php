<?php
require 'db.php';

// Get all attractions
$attractions = mysqli_query($conn, "SELECT attraction_id FROM attraction");

while ($row = mysqli_fetch_assoc($attractions)) {
    $attraction_id = $row['attraction_id'];

    // Average rating
    $avg_result = mysqli_query($conn, "
        SELECT AVG(rating) AS avg_rating
        FROM ratings
        WHERE attraction_id = '$attraction_id'
    ");
    $avg_rating = mysqli_fetch_assoc($avg_result)['avg_rating'] ?? 0;

    // Local rating + count
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
    $local_count  = $local_row['local_count'] ?? 0;

    // Non-local visits
    $non_local_result = mysqli_query($conn, "
        SELECT COUNT(*) AS non_local_visits
        FROM visits v
        JOIN user u ON v.user_id = u.user_id
        JOIN attraction a ON v.attraction_id = a.attraction_id
        WHERE v.attraction_id = '$attraction_id'
        AND u.city_id != a.city_id
    ");
    $non_local_visits = mysqli_fetch_assoc($non_local_result)['non_local_visits'] ?? 0;

    // Gem score logic
    if ($local_count < 5) {
        $gem_score = 0;
    } else {
        $gem_score = ((1 / ($non_local_visits + 1)) * 0.6) + ($local_rating * 0.4);
    }

    // Update attraction row
    mysqli_query($conn, "
        UPDATE attraction
        SET avg_rating = '$avg_rating',
            local_rating = '$local_rating',
            gem_score = '$gem_score'
        WHERE attraction_id = '$attraction_id'
    ");
}

echo "Attraction table updated successfully!";
