<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "crop_protection";

// Connect to MySQL server
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname`");

// Select the database
$conn->select_db($dbname);

// Create the 'sighting' table if it doesn't exist
$createTable = "CREATE TABLE IF NOT EXISTS sighting (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255) NOT NULL,
    species VARCHAR(255) NOT NULL,
    count INT NOT NULL,
    image VARCHAR(255),
    sighted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTable);
?>
