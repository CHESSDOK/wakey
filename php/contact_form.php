<?php
include 'conn_db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'mailer/vendor/autoload.php';

function sendMessageToSystem($userEmail, $subject, $userMessage) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jervinguevarra123@gmail.com';
        $mail->Password = 'wdul asom bddj yhfd'; // App password for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($userEmail); // Set user's email as sender
        $mail->addAddress('jervin1231@gmail.com'); // System email to receive the message

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = 'Message from: ' . $userEmail . '<br><br>' . nl2br($userMessage);

        $mail->send();
        echo 'Your message has been sent to the system.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sub = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO contact_us (name, email, subject, messages) VALUES ('$name', '$email', '$sub', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Send message to the system after inserting into the database
        sendMessageToSystem($email, $sub, $message);
        header("Location: ../html/contact.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
