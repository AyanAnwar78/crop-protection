<?php
include "db.php";

$location = $_POST['location']; 
$species = $_POST['species'];
$count = $_POST['count'];
$image = $_FILES['image']['name'];

$targetDir = "../uploads/";
$targetFile = $targetDir . basename($image);
move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

$sql = "INSERT INTO sighting (location, species, count, image) 
        VALUES ('$location', '$species', '$count', '$image')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $result = $conn->query("SELECT * FROM sighting WHERE id = $last_id");
    $newSighting = $result->fetch_assoc();
    
    echo json_encode(["success" => true, "message" => "Sighting added successfully!", "sighting" => $newSighting]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}



?>
