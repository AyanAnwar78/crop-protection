<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crop_protection";

// Step 1: Connect to Database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Step 3: Check if user exists
    $stmt = $conn->prepare("SELECT * FROM SignUP WHERE email = ? ");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1 ) 
    {
        $user = $result->fetch_assoc();
        if($user['password']===$pass)
        {
            header("Location: ../main.html");  // or dashboard page
        }
        else
        {
        echo "<script>alert('password is wrong');window.location.href = 'index.php';</script>";
        }
    } 
    else 
    {
        echo "<script>alert('User not found. Please Signup First!'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
