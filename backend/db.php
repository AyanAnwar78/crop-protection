<?php
$host = "localhost";  // Change if needed
$user = "root";       // Change if needed
$pass = "";           // Change if needed
$dbname = "wildlife"; // Database name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
