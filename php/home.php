<?php 
// Fetch 8 official images for the home masonry grid
session_start();
require 'db.php';

$images_result = mysqli_query($conn, "
    SELECT image_url, attraction_id 
    FROM gallery 
    WHERE is_official = 1 
    LIMIT 8
");

$pageTitle = "Home";
$pageStyle = "home.css";
include('header.php'); 
?>

        <section class = "hero-section">
            <h1 class = "home-title">Travel without the toll.</h1>
            <h2 class = "home-subtitle">Enjoy authentic experiences curated by locals, not algorithms—<br>
                all while preserving the world you came to see.</h2>
            <button class = "search-redirect" onclick = "window.location.href='search.php'">Discover hidden gems</button>
            <h6 class = "home-below">or browse some of our favorites below</h6>
        </section>

        <section class = "intro">
            <div class = "logo-page"><img src = "../images/logo-icon.png"></div>
            <h3>Off-Radar: Your Guide to Ethical Exploration</h3>
            <p>Social media has the power to influence the world's top travel destinations through 
                livestreams, reels, and aesthetically pleasing posts that make their way to hundreds 
                of thousands of users. Unfortunately, the more viral a place becomes on the internet, 
                the more prone it is to overtourism. Heavy foot traffic can often overwhelm local 
                infrastructures, and the increase of single-use plastics in tourist destinations can 
                often lead to littering, affecting the health of the residents and wildlife in the area.
            </p>

            <div class="masonry-container">
                <div id="grid" class="masonry-grid">
                    <?php if ($images_result && mysqli_num_rows($images_result) > 0): ?>
                        <?php while ($img = mysqli_fetch_assoc($images_result)): ?>
                            <?php 
                                // prepend ../ because home.php is inside php folder
                                $image_url = "../" . $img['image_url']; 
                            ?>
                            <div class="grid-item">
                                <a href="attraction.php?id=<?php echo $img['attraction_id']; ?>">
                                    <img src="<?php echo htmlspecialchars($image_url); ?>">
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No images available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- <div class = "masonry-container">
                <div id = "grid" class = "masonry-grid">
                    
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-1.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-2.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-3.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-4.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-5.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-6.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-7.jpg"></a>
                    </div>
                    <div class = "grid-item">
                        <a href = ""><img src = "../images/home-mg-8.jpg"></a>
                    </div>
                </div>
            </div> -->
        </section>

        <footer class = "footer">
            <p>Want to contribute? Log in or create and account <a href = "login.php">here</a>.</p>
        </footer>

        <!-- lagay ko nalang dito instead of a separate js file since onti lang naman  -->
        <script>
            window.onload = () => 
            {
                const grid = document.getElementById("grid");
                imagesLoaded(grid, () => 
                {
                    const masonry = new Masonry(grid, 
                    {
                        itemSelector: '.grid-item',
                        gutter: 10,
                        columnWidth: 200, 
                        fitWidth: true,
                        originLeft: true,
                        originTop: true
                    });
                });
            }
        </script>
    </body>
</html>
