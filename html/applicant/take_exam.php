<?php
include "../../php/conn_db.php";
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
$q_id = $_GET['q_id'];
$module_id = $_GET['module_id'];

$questions_query = "SELECT * FROM question WHERE quiz_id='$q_id' ORDER BY RAND() LIMIT 20";
$questions_result = mysqli_query($conn, $questions_query);

$sql = "SELECT * FROM register WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
    die("Invalid query: " . $conn->error); 
}

$row = $res->fetch_assoc();
if (!$row) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Exam</title>
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/exam.css">
</head>
<body>
<!-- Navigation -->
<nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>

    </nav>
    <header>
        <h1 class="h1">Quiz/Exam</h1>
    </header>

    <form class="form-box" action="../../php/applicant/submit_ans.php" method="POST">
        <input type="hidden" name="q_id" value="<?php echo htmlspecialchars($q_id); ?>">
        <input type="hidden" name="module_id" value="<?php echo htmlspecialchars($module_id); ?>">
        <?php
        $q_number = 1;
        while ($question = mysqli_fetch_assoc($questions_result)) {
            echo "<div class='question'>
                <p>Question {$q_number} :: " . htmlspecialchars($question['question']) . "</p>
                <input type='hidden' name='questions[]' value='{$question['id']}'>
                <label>A. <input type='radio' name='answers[{$question['id']}]' value='a'> " . htmlspecialchars($question['option_a']) . "</label><br>
                <label>B. <input type='radio' name='answers[{$question['id']}]' value='b'> " . htmlspecialchars($question['option_b']) . "</label><br>
                <label>C. <input type='radio' name='answers[{$question['id']}]' value='c'> " . htmlspecialchars($question['option_c']) . "</label><br>
                <label>D. <input type='radio' name='answers[{$question['id']}]' value='d'> " . htmlspecialchars($question['option_d']) . "</label><br>
            </div>";
            $q_number++;
        }
        ?>
        <div class="submit_btn">
        <button class="action" type="submit" name="submit">Submit</button>
    </div>
    </form>

    <script src="../../javascript/script.js"></script> 
</body>
</html>
