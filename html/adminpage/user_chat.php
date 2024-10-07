<?php
include 'conn_db.php';
$sql = "SELECT m.id, m.user_id, m.message, m.created_at, 
        CONCAT(ap.first_name, ' ', IFNULL(ap.middle_name, ''), ' ', ap.last_name) AS full_name
        FROM messages m
        INNER JOIN applicant_profile ap ON m.user_id = ap.user_id
        WHERE m.created_at = (
            SELECT MAX(m2.created_at) 
            FROM messages m2 
            WHERE m2.user_id = m.user_id
        )
        ORDER BY m.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat logs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/admin_ofw.css">
    <link rel="stylesheet" href="../../css/nav_float.css">
</head>
<body>

<!-- Navigation -->
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>
    <!-- Other navigation elements -->
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="ofw_case.php">OFW Cases</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chat Logs</li>
  </ol>
</nav>

<div class="table-containers">
<table class="table table-borderless table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>User_Info</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["full_name"] . "</td>
                        <td>" . $row["message"] . "</td>
                        <td>" . $row["created_at"] . "</td>
                        <td><a class='docu' href='ofw_chat.php?user_id=" . $row["user_id"] ."&message_id=".$row["id"]."'>View Chat</a></td>
                        <td><button id='adminChatBtn' class='adminChatBtn btn btn-primary'
                                    data-user-id='" . htmlspecialchars($row["user_id"]) . "' 
                                    data-message-id='" . htmlspecialchars($row["id"]) . "'>View Profile</button></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No messages found</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<!-- Modal for OFW chat -->
<div id="chatModal" class="modal modal-container">
    <div class="modal-content">
        <span class="btn-close closeBtn"></span>
        <div id="ofwChatContent">
            <!-- Profile details will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
    // Get modal and button elements for viewing profile
    const chatModal = document.getElementById('chatModal');
    const closeBtn = document.querySelector('.closeBtn');

    // Open profile modal and load data via AJAX
    $(document).on('click', '.adminChatBtn', function(e) {
        e.preventDefault();
        const userId = $(this).data('user-id');
        const messageId = $(this).data('message-id');
        
        $.ajax({
            url: 'ofw_chat.php',
            method: 'GET',
            data: { user_id: userId, message_id: messageId },
            success: function(response) {
                $('#ofwChatContent').html(response);
                chatModal.style.display = 'flex';
            }
        });
    });

    // Close profile modal when 'x' is clicked
    closeBtn.addEventListener('click', function() {
        chatModal.style.display = 'none';
    });

    // Close profile modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target === chatModal) {
            chatModal.style.display = 'none';
        }
    });
</script>

</body>
</html>
