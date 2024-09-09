<?php
session_start();
include 'conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = $conn->real_escape_string($_POST['user_input']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if the user_input is an email or username
    if (filter_var($user_input, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM register WHERE email='$user_input'";
    } else {
        $sql = "SELECT * FROM register WHERE username='$user_input'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 1) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user_input;
                
                header("Location: ../index(applicant).php");
            } else {
                echo "<script>alert('Please verify your email before logging in.');</script>";
            }
        } else {
            echo "<script>alert('Invalid username/email or password.');</script>";
        }
    } else {
        echo "<script>alert('No account found with this username/email.');</script>";
    }
}
?>
