<?php
include 'conn_db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM admin_profile WHERE BINARY email='$username'";
    } else {
        $sql = "SELECT * FROM admin_profile WHERE BINARY username='$username'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            header("Location: admin_home.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this username.";
    }
}

$conn->close();
?>
