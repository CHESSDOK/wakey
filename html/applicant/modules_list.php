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
$module_id = $_GET['course_id'];

// Check if 'modules_id' exists before using it
$selected_module_id = isset($_GET['modules_id']) ? $_GET['modules_id'] : null;

// Fetch all modules for the course
$sql = "SELECT * FROM modules WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $module_id);
$stmt->execute();
$modules_result = $stmt->get_result();

// Check if the user has taken any quiz for the course
$sql = "SELECT COUNT(*) AS quiz_count FROM user_score WHERE user_id = ? AND quiz_id IN (SELECT id FROM quiz_name WHERE module_id IN (SELECT id FROM modules WHERE course_id = ?))";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $module_id);
$stmt->execute();
$quiz_result = $stmt->get_result();
$quiz_data = $quiz_result->fetch_assoc();
$has_taken_any_quiz = $quiz_data['quiz_count'] > 0;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/Module.css">
</head>
<body>
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
        <h1 class="h1">Module List</h1>
    </header>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon" data-bs-toggle="popover" data-bs-placement="bottom">
    <?php if (!empty($row['photo'])): ?>
        <img id="preview" src="../../php/applicant/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
    <?php else: ?>
        <img src="../../img/user-placeholder.png" alt="Profile Picture" class="rounded-circle">
    <?php endif; ?>
    </div>



    </div>

    <!-- Burger icon -->
    <div class="burger" id="burgerToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>
</td>
</tr>
</table>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="menu">
                <tr><td><a href="../../index(applicant).php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="applicant.php" class="nav-link">Applicant</a></td></tr>
                <tr><td><a href="#" class="active nav-link">Training</a></td></tr>
                <tr><td><a href="ofw_home.php" class="nav-link">OFW</a></td></tr>
                <tr><td><a href="../../html/about.php" class="nav-link">About Us</a></td></tr>
                <tr><td><a href="../../html/contact.php" class="nav-link">Contact Us</a></td></tr>
            </table>
        </div>
    </div>
</nav>
    
<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../../index(applicant).php" >Home</a></li>
    <li class="breadcrumb-item"><a href="training_list.php" >Training</a></li>
    <li class="breadcrumb-item active" aria-current="page">Module</li>
  </ol>
</nav>
    <?php
    if ($modules_result->num_rows > 0) {
        $previous_module_passed = true; // Assume first module can be accessed
        while ($module_row = $modules_result->fetch_assoc()) {
            $current_module_id = $module_row['id'];
            
            // Check if the user has taken any quiz related to this module
            $stmt = $conn->prepare("SELECT * FROM user_score WHERE user_id = ? AND quiz_id IN (SELECT id FROM quiz_name WHERE module_id = ?)");
            $stmt->bind_param("ii", $userId, $current_module_id);
            $stmt->execute();
            $score_result = $stmt->get_result();
            $quiz_score = $score_result->fetch_assoc();
            
            // Determine if the user has passed the quiz
            $passed = ($quiz_score && $quiz_score['score'] >= 5); // Adjust passing score as needed
            
            // If the user hasn't taken any quiz yet, allow all modules to be enabled
            if (!$has_taken_any_quiz) {
                // All modules enabled since the user hasn't taken any quiz yet
                echo "<table>
                        <tr>
                            <td class='img_cell'><img class='icon' src='../../img/file_icon.png' alt='Logo'></td>
                            <td class='num_cell'> <p> " . $module_row["id"] . " </td>
                            <td class='title_cell'> <p> " . $module_row["module_name"] . " </td>
                            <td class='btn_cell'>
                                <a class='btn' href='module_content.php?user_id=" . $user_id . "&modules_id=" . $module_row["id"] . "&course_id=" . $module_id . "&module_name=" . $module_row["module_name"] . "'>view more <i class='fas fa-chevron-right'></i></a>
                            </td>
                        </tr>
                    </table>";
            } else {
                // Logic for unlocking and locking modules based on quiz score and progress
                if ($previous_module_passed || $passed) {
                    // Allow access to this module
                    echo "<table border='1'>
                            <tr>
                                <td class='img_cell'><img class='icon' src='../../img/file_icon.png' alt='Logo'></td>
                                <td class='num_cell'> <p> " . $module_row["id"] . " </td>
                                <td class='title_cell'> <p> " . $module_row["module_name"] . " </td>
                                <td class='btn_cell'>
                                    <a class='btn' href='module_content.php?user_id=" . $user_id . "&modules_id=" . $module_row["id"] . "&course_id=" . $module_id . "&module_name=" . $module_row["module_name"] . "'>view more <i class='fas fa-chevron-right'></i></a>
                                </td>
                            </tr>
                        </table>";
                    $previous_module_passed = $passed; // Set if current module passed
                } else {
                    // Lock this module because the user hasn't passed the previous module
                    echo "<table border='1'>
                            <tr>
                                <td class='img_cell'><img class='icon' src='../../img/file_icon_disabled.png' alt='Logo'></td>
                                <td class='num_cell'> <p> " . $module_row["id"] . " </td>
                                <td class='title_cell'> <p> " . $module_row["module_name"] . " (Locked) </td>
                                <td class='btn_cell'>
                                    <a class='btn' style='background-color: grey;' href='#' onclick='return false;'>Locked <i class='fas fa-lock'></i></a>
                                </td>
                            </tr>
                        </table>";
                    $previous_module_passed = false; // Ensure following modules stay locked
                }
            }
        }
    } else {
        echo "<tr><td colspan='4'>No modules found</td></tr>";
    }
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../../javascript/script.js"></script> 
</body>
</html>
