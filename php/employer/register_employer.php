<?php
include 'conn_db.php';
<?php
include 'conn_db.php';
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
    $username = $_POST['user'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert into empyers table
        $sql = "INSERT INTO empyers (username, password, email) VALUES ('$username', '$password', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            // Get the last inserted ID
            $employer_id = $conn->insert_id;

            // Insert into employer_profile table
            $sql = "INSERT INTO employer_profile (user_id, company_name, company_address) VALUES ('$employer_id', '', '')";
            
            if ($conn->query($sql) === TRUE) {
                // Commit the transaction
                $conn->commit();
                echo "New record and profile created successfully";
            } else {
                // Rollback the transaction if there's an error with the profile insert
                $conn->rollback();
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Rollback the transaction if there's an error with the registration insert
            $conn->rollback();
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of any exception
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
}
?>
