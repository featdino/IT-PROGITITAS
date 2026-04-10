
<!DOCTYPE html>

<html>
    <head>
        <title>Off-Radar | <?php echo $pageTitle; ?></title> 

        <meta charset = "UTF-8">

        <link rel = "icon" type = "image/png" href = "../images/logo-icon.png">

        <!-- fonts -->
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap">
        
        <!-- icons -->
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <!-- style for each page -->
        <link rel = "stylesheet" type = "text/css" href = "../css/<?php echo $pageStyle; ?>">

        <!-- CDN for masonry -->
        <script src = "https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        <script src = "https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    </head>

    <body>
        <header class = "header">
            <div class = "logo">
                <a href = "home.php"><img src = "../images/logo.png"></a>
            </div>

            <!-- php logic here : if may nakalogin, add this part of the code -->
             <?php if(isset($_SESSION['user_id'])) {
                echo '<a href="logout.php"><button class = "logout-btn">Log Out</button></a>';
             }
             ?>
            
            
            <input id = "toggle" type = "checkbox">
            <label class = "dropdown" for = "toggle">
                <i class = "fa-solid fa-bars"></i>
            </label>
        
            <div class = "menu">
                <a class = "link" href = "home.php">Home</a>
                <a class = "link" href = "search.php">Search Attractions</a>
                <a class = "link" href = "about.php">About Us</a>
                <a class = "link" href = "faqs.php">FAQs</a>
            </div>
        </header>
