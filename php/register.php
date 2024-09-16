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

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['user']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Validate password
    $passwordError = validatePassword($password);
    if ($passwordError !== "") {
        die("<script type='text/javascript'> alert('$passwordError'); window.location.href='../html/register.html'; </script>");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Generate a token for email verification
    $token = bin2hex(random_bytes(50));

    // Insert the new user into the register table
    $sql = "INSERT INTO register (email, username, password, token, is_verified) VALUES ('$email', '$username', '$hashedPassword', '$token', 0)";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        // Insert a new row in applicant_profile table
        $sql = "INSERT INTO applicant_profile (user_id, email) VALUES ('$last_id','$email')";

        if ($conn->query($sql) === TRUE) {
            // Send the verification email
            sendVerificationEmail($email, $token);

            // Redirect or alert the user
            echo "<script type='text/javascript'> alert('Registration successful! Please verify your email.'); window.location.href='../html/login.html'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function validatePassword($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    if (!preg_match("/\d/", $password)) {
        return "Password must contain at least one number.";
    }
    if (!preg_match("/[\W_]/", $password)) {
        return "Password must contain at least one special character.";
    }
    return "";
}
?>
