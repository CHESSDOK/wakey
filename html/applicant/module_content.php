<?php
include '../../php/conn_db.php';
session_start();
$userId = $_SESSION['id'];
$user_id = $_GET['user_id'];
$module_id = $_GET['modules_id'];

// Fetch the current user's details
$sql_user = "SELECT * FROM register WHERE id = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result_user = $stmt->get_result();

if (!$result_user) {
    die("Invalid query: " . $conn->error); 
}
$row_user = $result_user->fetch_assoc();
if (!$row_user) {
    die("User not found.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Module Content</title>
    
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/content.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <li><a href="" class="active">Training</a></li>
            <li><a href="#">OFW</a></li>
            <li><a href="../../html/about.php">About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
            <button id="emprof"><?php echo htmlspecialchars($row_user['username']); ?></button>
        </div>
    </nav>

    <!-- Page Content -->
    <header>
        <h1 class="h1">Content</h1>
    </header>
    
        <?php
        if ($result->num_rows > 0) {
            while ($row =fetch_assoc()) {
                
                echo htmlspecialchars($row["description"]) . '<br>';
                echo '<a href="' . htmlspecialchars($row['video']) . '" target="_blank">View Video &nbsp &nbsp </a>';
                echo '<a href="' . htmlspecialchars($row['file_path']) . '" target="_blank">Open File &nbsp &nbsp</a>';
                echo '<a href="quiz_list.php?modules_id=' . htmlspecialchars($row["id"]) . '">Take Quiz</a>';
                
            }
        } else {
            echo "<tr><td colspan='4'>No module content found</td></tr>";
        }
        $conn->close();
        ?> 

    <div class="btn-container">
        <a class="btn_back" href="modules_list.php?user_id=<?php echo htmlspecialchars($user_id); ?>&course_id=<?php echo htmlspecialchars($module_id); ?>">
            <i class="fas fa-caret-left"></i> Return
        </a>
    </div>

    <script src="../../javascript/script.js"></script>
</body>
</html>
