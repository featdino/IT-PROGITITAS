<!-- this is the page for each attraction's information and views -->

<?php
session_start(); 
require 'db.php'; 

// if(!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// sa search results, when attraction is clicked, the id should be passed in the url via attraction.php?id=<?php echo $attraction_id; /?/>
$attraction_id = $_GET['id'];

// Get attraction info
$query = "SELECT * FROM attraction WHERE attraction_id = '$attraction_id'";
$attraction_result = mysqli_query($conn, $query);
$attraction = mysqli_fetch_assoc($attraction_result);

// get attraction's categories
$query = "SELECT c.category FROM category c
          JOIN attraction_category ac ON c.category_id = ac.category_id
          WHERE ac.attraction_id = '$attraction_id'";
$categories_result = mysqli_query($conn, $query);
$categories = [];
while ($row = mysqli_fetch_assoc($categories_result)) {
    $categories[] = $row['category'];
}

// get attraction's official images
$query = "SELECT image_url FROM gallery WHERE attraction_id = '$attraction_id' AND is_official = 1";
$official_images_result = mysqli_query($conn, $query);
// store in array for accessing specific indexes
$official_images = [];
while ($row = mysqli_fetch_assoc($official_images_result)) {
    $official_images[] = $row;
}

// get attraction's visitor images
$query = "SELECT image_url FROM gallery WHERE attraction_id = '$attraction_id' AND is_official = 0";
$visitor_images = mysqli_query($conn, $query);

// check if user is logged in; user cannot be an admin (prevent admin from affecting ratings and visited status)
$is_logged_in = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';
$user_id = $is_logged_in ? $_SESSION['user_id'] : null;

// if logged in, check if user has visited the attraction (for marking visited and allowing rating)
$has_visited = false;
if ($is_logged_in) {
    $visit_check = mysqli_query($conn, "
        SELECT * FROM visits 
        WHERE user_id='$user_id' AND attraction_id='$attraction_id'
    ");
    $has_visited = mysqli_num_rows($visit_check) > 0;
}

// Check existing rating and retrieve for pre-filling the rating form if user has already rated
$user_rating = null;
if ($is_logged_in) {
    $rating_check = mysqli_query($conn, "
        SELECT rating FROM ratings 
        WHERE user_id='$user_id' AND attraction_id='$attraction_id'
    ");

    if ($row = mysqli_fetch_assoc($rating_check)) {
        $user_rating = $row['rating'];
    }
}

?>

<!DOCTYPE html>

<!-- template palang 'to so i'll be adding hardcoded info to be able to see lang muna
 how it would look visually.. indicate ko nalang which parts yung need machange into
 values retrieved from the database para madali + padelete nalang ng comments once done -->

<html>

    <head>
        <title>Off-Radar | <?php echo $attraction['name']; ?></title> 

        <link rel = "icon" type = "image/png" href = "../images/logo-icon.png">

        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap">
        
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel = "stylesheet" type = "text/css" href = "../css/attraction.css">
    </head>

    <body>
        <header class = "header">
            <div class = "logo">
                <a href = "home.html"><img src = "../images/logo.png"></a>
            </div>
 
            <input id = "toggle" type = "checkbox">
            <label class = "dropdown" for = "toggle">
                <i class = "fa-solid fa-bars"></i>
            </label>
        
            <div class = "menu">
                <!-- replace links later with .php once done -->
                <a class = "link" href = "home.html">Home</a>
                <a class = "link" href = "search.html">Search Attractions</a>
                <a class = "link" href = "about.html">About Us</a>
                <a class = "link" href = "faqs.html">FAQs</a>
            </div>
        </header>

        <!-- image srcs in this section to be replaced by first three official pics from db for each attraction -->
        <section class = "atr-spotlight-pictures">
            <div class = "main-pic">
                <img src = "../<?php echo $official_images[0]['image_url']; ?>">
                <button id = "gallery-modal-btn" class = "open-modal">
                    <i class = "fas fa-image"></i>
                </button>
            </div>
            <div class = "secondary-pics">
                <div class = "pic-2">
                    <img src = "../<?php echo $official_images[1]['image_url']; ?>">
                </div>
                <div class = "pic-3">
                    <img src = "../<?php echo $official_images[2]['image_url']; ?>">
                </div>
            </div>
        </section>


        <section class = "atr-titlebar">
            <div class = "nameplate">
                <h1><?php echo $attraction['name']; ?></h1> <!-- name of attraction ulit -->
                <p><?php echo $attraction['street_address']; ?></p> <!-- street address of attraction -->
            </div>
            <div class = "actions">

                <form method="POST" action="visit.php">
                    <input type="hidden" name="attraction_id" value="<?php echo $attraction_id; ?>">

                    <!-- users need to be logged in to mark as visited -->
                    <?php if ($is_logged_in): ?>
                        <button type="submit" class="mark-visited">
                            <?php if ($has_visited): ?>
                                <i class="fa fa-check-circle"></i> <!-- visited -->
                            <?php else: ?>
                                <i class="fa fa-check-circle-o"></i> <!-- not visited -->
                            <?php endif; ?>
                        </button>
                    <?php else: ?>
                        <!-- do styling here so that there's a prompt or modal that tells user to login -->
                        <!-- redirect user to login -->
                        <button type="button" class="mark-visited" onclick="window.location.href='login.php'">
                            <i class="fa fa-check-circle-o"></i> <!-- always show as not visited -->
                        </button>
                    <?php endif; ?>
                </form>

                <button id = "rating-modal-btn" class = "leave-rating">Leave Rating</button>

            </div>
        </section>

        <section class = "atr-scorecard">
            <div class = "local-rating">
                <h1><?php echo $attraction['local_rating']; ?></h1>
                <h4>Local Rating</h4> <!-- avg rating -->
            </div>
            <div class = "gem-score">
                <h1><?php echo $attraction['gem_score']; ?></h1>
                <h4>Gem Score</h4>
            </div>
            <div class = "tourist-visits">
                <h1><?php echo $attraction['total_visits']; ?></h1>
                <h4>Total Visits</h4> <!-- accumulated visists -->
            </div>
        </section>

        <section class = "atr-information">
            <div class = "description">
                <h3>ABOUT</h3>
                <p><?php echo $attraction['description']; ?></p> <!-- replace w description -->
            </div>
            <div class = "category">
                <h3>CATEGORY</h3>
                <p><?php echo implode(', ', $categories); ?></p>
            </div>
        </section>

        <section class = "atr-visitor-gallery">
            <h3>VISITOR'S GALLERY</h3>
            <div class = "visitor-gallery">
                <?php while ($visitor_image = mysqli_fetch_assoc($visitor_images)): ?>
                <div class = "gallery-item"><img src = "../<?php echo $visitor_image['image_url']; ?>"></div>
                <?php endwhile; ?>
            </div>
            <p>Want to contribute to the collection?</p>
            <button id = "upload-modal-btn" class = "upload-image">Upload Your Image</button>
        </section>

        <!-- MODALS (mga nagppop-up when some buttons are triggered) -->

        <!-- attaction official pictures: pag cinlick yung gallery button on top section -->
        <div id = "gallery-modal" class = "modal">
            <div class = "modal-content official-gallery">
                <div class = "modal-header gallery-header">
                    <div class = "title-block">
                        <h2><?php echo $attraction['name']; ?></h2>
                        <p>Official Gallery</p>

                        <!-- replace yung 6 with kung ilang official images meron -->
                        <p id = "slide-counter" class = "counter">1 / <?php echo count($official_images); ?></p> 
                    </div>
                    <button class = "close-btn" onclick = "closeGalleryModal()">
                        <i class = "fa fa-close"></i>
                    </button>
                </div>

                <div class = "slideshow-container">
                    <a class = "prev" onclick = "changeSlide(-1)">
                        <i class = "fa fa-chevron-left"></i>
                    </a>
                    
                    <div class = "slides-wrapper">  <!-- replace hrefs w official images from db -->
                        <?php foreach ($official_images as $official_image): ?>
                        <div class="ofc-image fade">
                            <img src="../<?php echo $official_image['image_url']; ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a class = "next" onclick = "changeSlide(1)">
                        <i class = "fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- leave rating form -->
        <div id = "rating-modal" class = "modal">
            <div class = "modal-content rating-content">
                <div class = "modal-header">
                    <div class = "title-block">
                        <h2 class = "modal-h2">Leave a Rating</h2>
                        <p class = "modal-p">Rate Your Experience at <b><?php echo $attraction['name']; ?></b></p> 
                    </div>
                </div>

                <!-- pakiapply nalang yung styling  -->
                <!-- users can only leave a rating IF they are logged in and have marked as visited -->
                <?php if (!$is_logged_in): ?>
                    <p style="text-align:center;">
                        <a href="login.php">Login</a> to leave a rating.
                    </p>

                <?php elseif (!$has_visited): ?>
                    <p style="text-align:center;">
                        You must mark this attraction as visited before rating.
                    </p>

                <?php else: ?>
                    <form action="rating.php" method="POST" class="modal-form">

                        <input type="hidden" name="attraction_id" value="<?php echo $attraction_id; ?>">

                        <div class="star-rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="rating" id="star-<?php echo $i; ?>" value="<?php echo $i; ?>"
                                    <?php if ($user_rating == $i) echo "checked"; ?>>
                                <label for="star-<?php echo $i; ?>" class="fas fa-star"></label>
                            <?php endfor; ?>
                        </div>

                        <div class = "modal-actions">
                            <button type="reset" class="cancel-btn" onclick="closeRatingModal()">Cancel</button>
                            <button type="submit" class="submit-btn">Submit Rating</button>
                        </div>
                    </form>

                <?php endif; ?>

            </div>
        </div>

        <!-- upload visitor image form: pag cinlick yung upload your image button -->
        <div id = "upload-modal" class = "modal">
            <div class = "modal-content rating-content">
                <div class = "modal-header">
                    <div class = "title-block">
                        <h2 class = "modal-h2">Share Your Memories</h2>
                        <p class = "modal-p">Upload a photo from your visit to <b><?php echo $attraction['name']; ?></b></p>
                    </div>
                </div>

                <!-- pakiapply nalang yung styling  -->
                <!-- users can only upload images IF they are logged in and have marked as visited -->
                <?php if (!$is_logged_in): ?>
                    <p style="text-align:center;">
                        <a href="login.php">Login</a> to upload images.
                    </p>

                <?php elseif (!$has_visited): ?>
                    <p style="text-align:center;">
                        You must mark this attraction as visited before uploading.
                    </p>

                <?php else: ?>
                    <form action="upload.php" method="POST" enctype="multipart/form-data" class="modal-form">
                        <div class="upload-group">
                            <label class="modal-label">Select Image:</label>
                            <input type="file" name="visitor_image[]" multiple accept="image/*"> <!-- up to 5 uploads -->
                        </div><br>

                        <input type="hidden" name="attraction_id" value="<?php echo $attraction_id; ?>">

                        <div class="modal-actions">
                            <button type="reset" class="cancel-btn" onclick="closeUploadModal()">Cancel</button>
                            <button type="submit" class="submit-btn">Upload to Gallery</button>
                        </div>
                    </form>

                <?php endif; ?>

            </div>
        </div>

        <script src = "../javascript/attraction.js"></script>
    </body>
</html>
