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
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/Module.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav>
        <!-- Your existing navigation code -->
    </nav>
    
    <header>
        <h1 class="h1">Module List</h1>
    </header>
    
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
</body>
</html>
