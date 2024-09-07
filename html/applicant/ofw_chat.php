<?php
    session_start();
    $userId = $_SESSION['id'];
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
            <!-- Messages will be loaded here -->
        </div>
        <form id="chat-form">
            <input type="hidden" id="userid" name="userid" value="<?php echo $userId?>" required>
            <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        // Load chat messages every 2 seconds
        function loadMessages() {
            $.ajax({
                url: 'load_messages.php',
                method: 'GET',
                success: function(data) {
                    $('#chat-box').html(data);
                }
            });
        }

        // Send message via Ajax
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../../php/applicant/send_message.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#message').val('');
                    loadMessages(); // Reload chat after sending
                }
            });
        });

        // Initial chat load
        loadMessages();
        // Reload chat every 2 seconds
        setInterval(loadMessages, 2000);
    </script>
</body>
</html>
