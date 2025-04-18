<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';



if (isset($_POST['Submit'])) {
    //todo--> Create an instance: passing `true` enamble e;
    $mail = new  PHPMailer(true);

    //todo-->  using try for exception;
    try {

        //todo-->  connection stabilish
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maheshwaridhruva0@gmail.com';
        $mail->Password = 'ufuo dmrk zvay ikmy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //todo-->  Recipients
        $mail->setFrom($_POST['email'], 'DM');
        $mail->addAddress('maheshwaridhruva0@gmail.com', 'chirag sir');
        $mail->addReplyTo('maheshwaridhruva0@gmail.com', 'CID');

        //todo-->  Attachements
        // $mail->addAttachment($_POST['message']);
        //todo--> content
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];
        // $mail->AltBody = 'This is the body in palin text for non-HTML client';

        //todo-->  call the function;
        $mail->send();
        echo "<script> alert('Email send')</script>";
        
    } catch (Exception $e) {
        echo "mail can not be sent <br>";
        echo "the error is: {$mail->ErrorInfo}";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <nav class="flex fixed top-0 justify-between items-center bg-white shadow-md w-full  px-6 py-3">
        <div class="flex items-center space-x-3">
            <img src="./image/a87020df-7af7-40d8-aba1-61c7819f1e46.jpg" alt="CropGuard Logo" class="h-10 w-10 rounded-full border-2 border-green-400">
            <h1 class="text-xl font-bold text-green-800 font-sans">Crop Protection</h1>
        </div>
        <div class="hidden md:flex items-center space-x-6">
            <a href="main.html" class="text-gray-700 hover:text-green-600 transition-colors flex items-center">
                Home
            </a>
            <a href="weather.html" class="text-gray-700 hover:text-green-600 transition-colors flex items-center">
                Weather
            </a>
            <a href="./leader.html" class="text-gray-700 hover:text-green-600 transition-colors flex items-center">
                Experts
            </a>
            <a href="contact.html" class="text-gray-700 hover:text-green-600 transition-colors flex items-center">
                Contact
            </a>
        </div>
    </nav>
    <form class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg animate-fade-in" method="post">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">Send Email</h2>

        <!-- To -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium" for="to">From</label>
            <input type="email" name="email" required placeholder="receiver@example.com"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
        </div>

        <!-- Subject -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium" for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required placeholder="Enter subject"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
        </div>

        <!-- Message -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium" for="message">Message</label>
            <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition resize-none"></textarea>
        </div>

        <!-- Send Button -->
        <button type="submit" name="Submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
            Send Email
        </button>
    </form>



</body>

</html>