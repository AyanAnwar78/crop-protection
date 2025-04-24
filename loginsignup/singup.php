<?php
$servername = "localhost";
$username = "root";
$fname = "";
$lname = "";
$password = "";
$email = "";
$dbname = "crop_protection";

// Step 1: Connect to MySQL Server
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Create the Database if not exists
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sqlCreateDB);

// Step 3: Select the database
$conn->select_db($dbname);

// Step 4: Create the Table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS SignUP (
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sqlCreateTable);



// Step 5: Prepare and Insert the Data using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $pass = $_POST['password'];
    $email = $_POST['email'];

    $st = $conn->prepare("SELECT * FROM SignUP WHERE email = ? ");
    $st->bind_param("s", $email);
    $st->execute();
    $result = $st->get_result();

    $user = $result->fetch_assoc();

    if ($user['email'] === $email) {
        echo "<script>alert('email is already login');window.location.href = 'index.php';</script>";
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO SignUP (fname , lname,password,email) VALUES (?, ?,?,?)");
        $stmt->bind_param("ssss", $fname, $lname, $pass, $email);

        if ($stmt->execute()) {
            header("Location: ../main.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
