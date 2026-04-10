<!-- paste the search html code after php code if done -->

<?php
session_start(); 
require 'db.php'; 

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$searchResults = [];

if ($query !== '') {
    // get each keyword separated by a space from the search query 
    $keywords = explode(" ", $query);

    // add a condition to search for each keyword in the attraction's name and description
    $conditions = [];
    foreach ($keywords as $word) {
        $word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "(name LIKE '%$word%' OR description LIKE '%$word%')";
    }

    // combine each condition with AND to ensure all keywords are present in the results
    $sql = "SELECT * FROM attraction WHERE " . implode(" AND ", $conditions);
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }

    // Redirect to results.php or watever the listings of attractions page is called with query string
    header("Location: results.php?query=" . urlencode($query));
    exit();
}

$pageTitle = "Search";
$pageStyle = "search.css";
include('header.php'); 
?>
    <div class="search-container">
        <div class="logo-page"><img src="../images/logo-icon.png" alt="Off-Radar Logo"></div>

        <h1>What's on your itinerary?</h1>

        <div class="search-bar-container">
            <form id="search-form" class="search-form" method="GET" action="search.php">
                <input type="search" class="search-bar" name="query" placeholder="Search attractions..." required>
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <p class="prompt">Not sure what you're looking for? Have a look under these categories:</p>

        <div class="tags">
            <div class="upper-tags">
                <button class="tag green">Cultural & Historical</button>
                <button class="tag gray">Food & Drink</button>
                <button class="tag dark-green">Nature & Outdoors</button>
                <button class="tag navy">Entertainment & Leisure</button>
            </div>
            <div class="lower-tags">
                <button class="tag dark-green">Baguio City</button>
                <button class="tag navy">Manila City</button>
                <button class="tag gray">Top Rated Hidden Gems</button>
            </div>
        </div>
    </div>
</body>
</html>