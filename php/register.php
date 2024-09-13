<?php
include 'conn_db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'mailer/vendor/autoload.php';

function sendVerificationEmail($email, $token) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'jervinguevarra123@gmail.com'; // SMTP username
        $mail->Password = 'wdul asom bddj yhfd'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('jervinguevarra123@gmail.com', 'PESO-lb.ph');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Click on the link to verify your email: <a href="http://localhost/wakey/php/verify.php?token=' . $token . '">Verify Email</a>';

        $mail->send();
        echo 'Verification email has been sent.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['user']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));

    if (strlen($password) < 8 || strlen($password) > 16) {
        echo "<script type='text/javascript'>alert('Password must be between 8 and 16 characters.'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO register (email, username, password, token, is_verified) VALUES ('$email', '$username', '$password', '$token', 0)";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $sql = "INSERT INTO applicant_profile (user_id) VALUES ('$last_id')";
        
        if ($conn->query($sql) === TRUE) {
            sendVerificationEmail($email, $token);
            echo "<script type='text/javascript'> alert('Registration successful! Please verify your email.') ;window.location.href='../html/login.html'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
