<?php
session_start(); 
require 'db.php'; 

$pageTitle = "Search";
$pageStyle = "search.css";
include('header.php'); 
?>
    <div class="search-container">
        <div class="logo-page"><img src="../images/logo-icon.png" alt="Off-Radar Logo"></div>

        <h1>What's on your itinerary?</h1>

        <div class="search-bar-container">
            <form id="search-form" class="search-form" method="GET" action="listings.php">
                <input type="search" class="search-bar" name="query" placeholder="Search attractions..." required>
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <p class="prompt">Not sure what you're looking for? Have a look under these categories:</p>

        <div class="tags">
            
            <div class="upper-tags">
                <form method="GET" action="listings.php">
                    <input type="hidden" name="category_id" value="1">
                    <button type="submit" class="tag green">Museums & Galleries</button>
                </form>
                <form method="GET" action="listings.php">
                    <input type="hidden" name="category_id" value="5">
                    <button type="submit" class="tag gray">Cafes & Bistros</button>
                </form>
                <form method="GET" action="listings.php">
                    <input type="hidden" name="category_id" value="10">
                    <button type="submit" class="tag dark-green">Parks & Gardens</button>
                </form>
                <form method="GET" action="listings.php">
                    <input type="hidden" name="category_id" value="14">
                    <button type="submit" class="tag navy">Theme Parks</button>
                </form>
            </div>

            <div class="lower-tags">
                <form method="GET" action="listings.php">
                    <input type="hidden" name="city_id" value="11">
                    <button type="submit" class="tag dark-green">Baguio City</button>
                </form>
                <form method="GET" action="listings.php">
                    <input type="hidden" name="city_id" value="1">
                    <button type="submit" class="tag navy">Manila City</button>
                </form>
                <form method="GET" action="listings.php">
                    <input type="hidden" name="top_rated" value="1">
                    <button type="submit" class="tag gray">Top Rated Hidden Gems</button>
                </form>
            </div>
        
        </div>
    </div>
</body>
</html>