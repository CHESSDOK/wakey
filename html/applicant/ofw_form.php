<?php
include '../../php/conn_db.php';
session_start();
$userId = $_SESSION['id'];

$sql = "SELECT * FROM register WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . $conn->error); 
}

$row = $result->fetch_assoc();
if (!$row) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFW Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/ofw_form.css">
</head>
<body>
     <!-- Navigation -->
     <nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>
        <label class="burger" for="burger">
            <input type="checkbox" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="../../index(applicant).php">Home</a></li>
            <li><a href="applicant.php">Applicant</a></li>
            <li><a href="training_list.php">Training</a></li>
            <li><a href="#" class="active">OFW</a></li>
            <li><a href="../../html/about.php" >About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>
  
    <header>
        <h1 class="h1">File a Case</h1>
    </header>

    <div class="container input-group"  class="">
    <form action="../../php/applicant/submit_case.php" method="POST" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>
                    <label class="info" for="title">Case Title:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control"  type="text" name="title" id="title" required>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                      <textarea class="form-control text-comment" placeholder="" id="floatingTextarea"></textarea>
                      <label for="floatingTextarea">Case Description:</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="info" for="file">Upload Supporting File:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control"  type="file" name="file" id="file">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Submit Case</button>
                </td>
            </tr>
        </table>
    </form>
</div>


<!-- Offcanvas Component -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="chatOffcanvas" aria-labelledby="chatOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 id="chatOffcanvasLabel">Chat with Admin</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
           <?php
           if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<h2>Message from " . $_SESSION['username'] . "</h2>";
                echo "<p>" . $row["message"] . "</p>";
        
                $reply_sql = "SELECT * FROM replies WHERE message_id = '" . $row["id"] . "'";
                $reply_result = $conn->query($reply_sql);
        
                if ($reply_result->num_rows > 0) {
                while($reply_row = $reply_result->fetch_assoc()) {
                    $admin_sql = "SELECT * FROM admin_profile WHERE id = '" . $reply_row["admin_id"] . "'";
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
        <form action="../../php/applicant/send_message.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_Id ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea><br><br>
            <input type="submit" value="Send Message">
        </form>
</div>
<div class="chat-conainer">
<a class="chat-admin" data-bs-toggle="offcanvas" data-bs-target="#chatOffcanvas">
    <i class="bi bi-chat-dots"></i> Chat with Admin
</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>     
<script src="../../javascript/script.js"></script> 

</body>
</html>
