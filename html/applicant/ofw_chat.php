<?php
    include '../../php/conn_db.php';
    session_start();
    $user_Id = $_SESSION['id'];
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
                    $admin_sql = "SELECT * FROM admins_profile WHERE id = '" . $reply_row["admin_id"] . "'";
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
