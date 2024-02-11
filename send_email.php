<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $headers = "From: nate.ku24@gmail.com";

    echo "To: " . $to . "<br>";
    echo "Subject: " . $subject . "<br>";

    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully";
    } else {
        echo "Failed to send message";
        // Check for additional details about the error
        echo "Error: " . error_get_last()['message'];
    }
}
?>
