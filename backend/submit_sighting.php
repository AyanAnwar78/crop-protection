<?php
include "db.php";

// Check for POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = $_POST['location'] ?? '';
    $species = $_POST['species'] ?? '';
    $count = isset($_POST['count']) ? (int)$_POST['count'] : 0;
    $imageName = $_FILES['image']['name'] ?? '';
    $imageTmp = $_FILES['image']['tmp_name'] ?? '';

    $uploadDir = "uploads/";
    $targetPath = $uploadDir . basename($imageName);

    // Create the uploads folder if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Move uploaded file to target folder
    if ($imageName && move_uploaded_file($imageTmp, $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO sighting (location, species, count, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $location, $species, $count, $imageName);

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;
            $res = $conn->query("SELECT * FROM sighting WHERE id = $last_id");
            $newSighting = $res->fetch_assoc();

            echo json_encode([
                "success" => true,
                "message" => "Sighting added successfully!",
                "sighting" => $newSighting
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Database insert failed."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Image upload failed."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
