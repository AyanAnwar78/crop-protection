<?php
header('Content-Type: application/json');

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crop_protection';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $firstName = $input['firstName'] ?? '';
    $lastName = $input['lastName'] ?? '';
    $email = $input['email'] ?? '';
    $address = $input['address'] ?? '';
    $message = $input['message'] ?? '';

    if (empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'All fields are required']);
        exit;
    }

    try {
        // Connect to MySQL server
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create database if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $pdo->exec("USE $dbname");

        // Create table if not exists
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS forum (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(100),
                last_name VARCHAR(100),
                email VARCHAR(150),
                address VARCHAR(255),
                message TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Insert data
        $stmt = $pdo->prepare("
            INSERT INTO forum (first_name, last_name, email, address, message)
            VALUES (:firstName, :lastName, :email, :address, :message)
        ");
        $stmt->execute([
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':email' => $email,
            ':address' => $address,
            ':message' => $message
        ]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
