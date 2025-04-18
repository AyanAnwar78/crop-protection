<?php
include "db.php";

$sql = "SELECT * FROM sighting ORDER BY sighted_at DESC";
$result = $conn->query($sql);

$sightings = [];
while ($row = $result->fetch_assoc()) {
    $sightings[] = $row;
}

echo json_encode($sightings);
$conn->close();
?>
