<!-- change port nalang in case hindi 3306 gamit nyo -->

<?php
$host     = 'localhost:3306';
$dbname   = 'project title off-radar';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// padelete nalang else statement later on, inadd ko lang pang test kung gumagana yung connection
else {
    echo "Connected successfully to the database.";
}
?>
