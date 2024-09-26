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
$userId = checkSession();
$user_id = $_GET['user_id'];
$module_id = $_GET['modules_id'];
$module_name = $_GET['module_name'];

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

// Fetch module content
$sql_module = "SELECT * FROM module_content WHERE modules_id = ?";
$stmt = $conn->prepare($sql_module);
$stmt->bind_param("i", $module_id);
$stmt->execute();
$result_module = $stmt->get_result();

if (!$result_module) {
    die("Invalid query: " . $conn->error);
}

$sql_quiz = "SELECT * FROM quiz_name WHERE module_id = ?";
$stmt_quiz = $conn->prepare($sql_quiz);
$stmt_quiz->bind_param("i", $module_id);
$stmt_quiz->execute();
$result_quiz = $stmt_quiz->get_result();

if ($row_quiz = $result_quiz->fetch_assoc()) {
    // Store quiz ID and name
    $quiz_id = $row_quiz['id'];
} else {
    $quiz_id = null;
}

$module_id = $_GET['course_id'];
$sql = "SELECT * FROM modules WHERE course_id = $module_id ";
$result = $conn->query($sql);
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
        if ($result_module->num_rows > 0) {
            while ($row = $result_module->fetch_assoc()) {
                echo '<div class="container">';
                    echo '<p class="label">' . htmlspecialchars($module_name) . '</p>' . '<div class="divider"></div>';
                    echo '<p class="info">' . htmlspecialchars($row["description"]) . '</p>';
                        echo '<a class="video" href="' . htmlspecialchars($row['video']) . '" target="_blank">
                              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/YouTube_icon_%282013-2017%29.png/1200px-YouTube_icon_%282013-2017%29.png" 
                              alt="YouTube Logo" style="width: 45px; height: 30px; vertical-align: middle;">
                              View Video</a>';
                        echo '<a href="' . htmlspecialchars($row['file_path']) . '" target="_blank">
                              <img class="icon" src="../../img/file_icon.png" alt="Logo" style="width: 32.5px; height: 35px; vertical-align: middle;">
                              Open File</a>';
                        echo '<a href="take_exam.php?module_id=' . htmlspecialchars($row["modules_id"]) . '&q_id=' . htmlspecialchars($quiz_id) . '" target="_blank">
                              <img class="icon" src="../../img/quiz.png" alt="Logo" style="width: 32.5px; height: 35px; vertical-align: middle;">
                              Take Quiz</a>';
                echo '</div>';
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