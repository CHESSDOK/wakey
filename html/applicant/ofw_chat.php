<?php
    include '../../php/conn_db.php';
    function checkSession() {
        session_start(); // Start the session
    
        // Check if the session variable 'id' is set
        if (!isset($_SESSION['id'])) {
            // Redirect to login page if session not found
            header("Location: ../login.html");
            exit();
        } else {
            // If session exists, store the session data in a variable
            return $_SESSION['id'];
        }
    }
    $user_Id = checkSession();
    $sql = "SELECT * FROM messages WHERE user_id = '$user_Id'";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Admin</title>
    <link rel="stylesheet" href="../../css/ofw.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="chat-container">
        <div class="chat-box" id="chat-box">
           <?php
           if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<h2>Message from " . $_SESSION['username'] . "</h2>";
                echo "<p>" . $row["message"] . "</p>";
        
                $reply_sql = "SELECT * FROM replies WHERE message_id = '" . $row["id"] . "'";
                $reply_result = $conn->query($reply_sql);
        
                if ($reply_result->num_rows > 0) {
                while($reply_row = $reply_result->fetch_assoc()) {
<<<<<<< HEAD
                    $admin_sql = "SELECT * FROM admins_profile WHERE id = '" . $reply_row["admin_id"] . "'";
=======
                    $admin_sql = "SELECT * FROM admin_profile WHERE id = '" . $reply_row["admin_id"] . "'";
>>>>>>> 6d4ed446a2f10b7af951a9aef7e071aadc7c636c
                    $admin_result = $conn->query($admin_sql);
                    $admin_row = $admin_result->fetch_assoc();
                    echo "<h2>Reply from " . $admin_row["username"] . "</h2>";
                    echo "<p>" . $reply_row["reply"] . "</p>";
                }
                } else {
                echo "<p>No replies found.</p>";
                }
            }
            } else {
            echo "<p>No messages found.</p>";
            }
           ?>
        </div>
        <form action="../../php/applicant/send_message.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_Id ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea><br><br>
            <input type="submit" value="Send Message">
        </form>
    </div>
</body>
</html>
