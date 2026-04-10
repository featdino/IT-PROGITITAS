<!-- this is the page of attraction listings, after search input and/or category filters -->
<?php
session_start();
require 'db.php';

$query       = isset($_GET['query']) ? trim($_GET['query']) : '';
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
$city_id        = isset($_GET['city_id']) ? $_GET['city_id'] : 0;
$topRated    = isset($_GET['top_rated']) ? true : false;

$conditions = [];

// add conditions if user searched for something
if ($query !== '') {
    // split keywords by space and find them from attraction names or descriptions
    $keywords = explode(" ", $query);
    foreach ($keywords as $word) {
        $word = mysqli_real_escape_string($conn, $word);
        $conditions[] = "(a.name LIKE '%$word%' OR a.description LIKE '%$word%')";
    }
}

// base query
$sql = "
    SELECT a.attraction_id, a.name, a.description, a.gem_score,
           ci.city_name,
           (SELECT c.category 
            FROM category c 
            JOIN attraction_category ac ON c.category_id = ac.category_id 
            WHERE ac.attraction_id = a.attraction_id LIMIT 1) AS category,
           (SELECT g.image_url 
            FROM gallery g 
            WHERE g.attraction_id = a.attraction_id AND g.is_official = 1 LIMIT 1) AS image_url
    FROM attraction a
    LEFT JOIN city ci ON a.city_id = ci.city_id
    WHERE 1=1
";

// filters
if ($category_id > 0) {
    $conditions[] = "EXISTS (
        SELECT 1 FROM attraction_category ac
        WHERE ac.attraction_id = a.attraction_id
        AND ac.category_id = $category_id
    )";
}
if ($city_id > 0) {
    $conditions[] = "a.city_id = $city_id";
}
if ($topRated) {
    $conditions[] = "a.gem_score >= 1.9";
}

if (!empty($conditions)) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY a.gem_score DESC";

$result = mysqli_query($conn, $sql);
$num_attractions = $result ? mysqli_num_rows($result) : 0;

$pageTitle = "Discover";
$pageStyle = "listings.css";
include('header.php'); 
?>

		<div class = "page-wrapper">
			<div class = "listings-header">
				<h1>Explore Attractions</h1>
				<p>Browse hidden gems, local favorites, and must-visit places.</p>
			</div>
			
			<div class = "search-summary">
				<div class = "left-text">
					Showing <?php echo $num_attractions; ?> attractions under <!-- number of returned results -->
					<?php if ($city_id > 0): ?>
						<?php
						$city_query = mysqli_query($conn, "SELECT city_name FROM city WHERE city_id = $city_id");
						if ($city_row = mysqli_fetch_assoc($city_query)):
						?>
							under <span class="filter-tag"><?php echo htmlspecialchars($city_row['city_name']); ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ($query !== ''): ?>
						for <span class="filter-tag"><?php echo htmlspecialchars($query); ?></span>
					<?php endif; ?>

					<?php if ($category_id > 0): ?>
						<?php
						$cat_query = mysqli_query($conn, "SELECT category FROM category WHERE category_id = $category_id");
						if ($cat_row = mysqli_fetch_assoc($cat_query)):
						?>
							in <span class="filter-tag"><?php echo htmlspecialchars($cat_row['category']); ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ($topRated): ?>
						filtered by <span class="filter-tag">Top Rated Hidden Gems</span>
					<?php endif; ?>
					<!-- <span class = "filter-tag">Baguio City</span> the applied filter -->
					<!-- if search: 
					<span class = "filter-tag">yung sinearch na</span> 
					-->
				</div>
			</div>

			<div class = "results-grid"> <!-- container for all attractions -->

				<?php if ($result && mysqli_num_rows($result) > 0): ?>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<?php
						$image_url = $row['image_url'] ? "../" . $row['image_url'] : "../images/default.jpg";
						$category_name = $row['category'] ? $row['category'] : "Uncategorized";
						$city_name = $row['city_name'] ? $row['city_name'] : "Unknown City";
						
						$gem_score = $row['gem_score'];
						if ($gem_score < 1.0) {
							$rating_class = "listing-rating bad";
						} elseif ($gem_score >= 1.0 && $gem_score <= 1.7) {
							$rating_class = "listing-rating avg";
						} else {
							$rating_class = "listing-rating good";
						}
						?>
						<div class="listing-card">
							<img src="<?php echo htmlspecialchars($image_url); ?>" class="listing-image">
							<div class="listing-content">
								<div class="listing-top">
									<h2 class="listing-title"><?php echo htmlspecialchars($row['name']); ?></h2>
									<span class="<?php echo $rating_class; ?>">
										<?php echo number_format($gem_score, 1); ?> ★
									</span>
								</div>
								<p class="listing-location"><?php echo htmlspecialchars($city_name); ?></p>
								<p class="listing-description"><?php echo htmlspecialchars($row['description']); ?></p>
								<div class="listing-footer">
									<span class="category-tag"><?php echo htmlspecialchars($category_name); ?></span>
									<a href="attraction.php?id=<?php echo $row['attraction_id']; ?>" class="view-btn">View Details</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php else: ?>
					<p>No attractions found matching your filters.</p>
				<?php endif; ?>

			</div>

		</div>

	</body>
</html>
