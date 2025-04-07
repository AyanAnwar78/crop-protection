<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "crop_protection"; // Use your existing wildlife database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$city = $_GET['city'] ?? '';

if ($city) {
    // Check if data exists and is recent (within 30 minutes)
    $stmt = $conn->prepare("SELECT * FROM weather_data WHERE city = ? AND TIMESTAMPDIFF(MINUTE, last_updated, NOW()) < 30");
    $stmt->bind_param("s", $city);
    $stmt->execute();
    $result = $stmt->get_result();
    $weather = $result->fetch_assoc();

    if ($weather) {
        echo json_encode($weather);
    } else {
        // Fetch from API if not in DB or outdated
        $apiKey = "156d9e29e84dfcd1f8472d9e8fee3031";
        $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data["cod"] == 200) {
            // Store/update data in the wildlife database
            $stmt = $conn->prepare("INSERT INTO weather_data (city, country, temperature, description, humidity, last_updated)
                VALUES (?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE temperature=?, description=?, humidity=?, last_updated=NOW()");
            $stmt->bind_param("ssdsdssd", $data['name'], $data['sys']['country'], $data['main']['temp'], $data['weather'][0]['description'], $data['main']['humidity'], $data['main']['temp'], $data['weather'][0]['description'], $data['main']['humidity']);
            $stmt->execute();

            echo json_encode([
                "city" => $data['name'],
                "country" => $data['sys']['country'],
                "temperature" => $data['main']['temp'],
                "description" => $data['weather'][0]['description'],
                "humidity" => $data['main']['humidity']
            ]);
        } else {
            echo json_encode(["error" => "City not found"]);
        }
    }
} else {
    echo json_encode(["error" => "City parameter missing"]);
}

$conn->close();
?>