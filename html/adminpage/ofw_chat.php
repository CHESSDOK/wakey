<?php
    include 'conn_db.php';
    session_start();
    $admin_Id = $_SESSION['id'];

    $message_id = $_GET['message_id'];
    $sql = "SELECT * FROM messages WHERE id = '$message_id'";
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
                $row = $result->fetch_assoc();
                $user_sql = "SELECT * FROM register WHERE id = '" . $row["user_id"] . "'";
                $user_result = $conn->query($user_sql);
                $user_row = $user_result->fetch_assoc();
                echo "<h2>Message from " . $user_row["username"] . "</h2>";
                echo "<p>" . $row["message"] . "</p>";
                }
            
                $sql = "SELECT * FROM replies WHERE message_id = '$message_id'";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $admin_sql = "SELECT * FROM admin_profile WHERE id = '" . $row["admin_id"] . "'";
                    $admin_result = $conn->query($admin_sql);
                    $admin_row = $admin_result->fetch_assoc();
                    echo "<h2>Reply from " . $admin_row["username"] . "</h2>";
                    echo "<p>" . $row["reply"] . "</p>";
                }
                } else {
                echo "No replies found.";
                }
           ?>
        </div>
        <form action="send_message.php" method="post">
            <input type="numeber" name="admin_id" value="<?php echo $admin_Id ?>">
            <input type="hidden" name="message_id" value="<?php echo $message_id ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="reply"></textarea><br><br>
            <input type="submit" value="Send Message">
        </form>
    </div>
</body>
</html>
