<!-- change port nalang in case hindi 3306 gamit nyo -->

<?php
$host     = 'localhost:3308';
$dbname   = 'off-radar';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>