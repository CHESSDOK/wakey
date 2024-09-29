<?php
include '../conn_db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../mailer/vendor/autoload.php';

function sendOtpEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'jervinguevarra123@gmail.com'; // SMTP username
        $mail->Password = 'wdul asom bddj yhfd'; // SMTP password (Use app-specific password for Gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('jervinguevarra123@gmail.com', 'PESO-lb.ph');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP Verification';
        $mail->Body = 'Your OTP for email verification is: <b>' . $otp . '</b>. It will expire in 10 minutes.';

        $mail->send();
        echo 'OTP email has been sent.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['user']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $otp = mt_rand(100000, 999999);

    date_default_timezone_set('Asia/Manila');
    $otp_expiry = date("Y-m-d H:i:s", strtotime('+5 minutes'));
    $sql = "INSERT INTO empyers (email, username, password, otp, otp_expiry, is_verified) 
            VALUES ('$email', '$username', '$hashedPassword', '$otp', '$otp_expiry', 0)";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

    $sql = "INSERT INTO employer_profile (user_id, company_name, company_address) 
            VALUES ('$last_id', '', '')";
    if ($conn->query($sql) === TRUE) {
        // Send the OTP email
        sendOtpEmail($email, $otp);

        // Redirect or alert the user
        echo "<script type='text/javascript'> 
                alert('Registration successful! Please verify your email using the OTP sent.');
                window.location.href='../../html/employer/otp_verification.html'; 
              </script>";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
            
}
?>
