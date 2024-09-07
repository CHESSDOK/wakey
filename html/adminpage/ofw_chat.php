<?php
session_start();
$adminid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Panel</title>
    <link rel="stylesheet" href="../../css/ofw.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="chat-container">
        <h2>Admin Chat</h2>
        <div class="chat-box" id="chat-box">
            <!-- Messages will be loaded here -->
        </div>
        <form id="admin-chat-form">
            <input type="hidden" id="adminid" name="adminid" value="<?php echo $adminid; ?>">
            <textarea id="admin-message" name="admin_message" placeholder="Enter your reply" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        // Function to load chat messages every 2 seconds
        function loadMessages() {
            $.ajax({
                url: 'load_messages.php',
                method: 'GET',
                success: function(data) {
                    $('#chat-box').html(data);
                }
            });
        }

        // Submit admin message via Ajax
        $('#admin-chat-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#admin-message').val('');  // Clear input after sending
                    loadMessages();  // Reload chat after sending
                }
            });
        });

        // Load chat on page load and every 2 seconds
        loadMessages();
        setInterval(loadMessages, 2000);
    </script>
</body>
</html>

