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
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/ofw.css">
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

    <form action="../../php/applicant/submit_case.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <label for="title">Case Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Case Description:</label><br>
        <textarea name="description" id="description" rows="5" required></textarea><br><br>

        <label for="file">Upload Supporting File:</label>
        <input type="file" name="file" id="file"><br><br>

        <button type="submit">Submit Case</button>
    </div>
    </form>
    <a href="ofw_chat.php">chat with admin</a>

    <script src="../../javascript/script.js"></script> 
</body>
</html>
