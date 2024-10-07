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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/module_quiz.css">
</head>
<body>
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
        <h1 class="h1">Quiz</h1>
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
    <li class="breadcrumb-item"><a href="modules_list.php?user_id=<?php echo htmlspecialchars($user_id); ?>&course_id=<?php echo htmlspecialchars($module_id); ?>" >Module</a></li>
    <li class="breadcrumb-item"><a href="modules_list.php?user_id=<?php echo htmlspecialchars($user_id); ?>&course_id=<?php echo htmlspecialchars($module_id); ?>" >Material</a></li>
    <li class="breadcrumb-item active" aria-current="page">Quiz</li>
  </ol>
</nav>

    <form class="form-box" action="../../php/applicant/submit_ans.php" method="POST">
        <input type="hidden" name="q_id" value="<?php echo htmlspecialchars($q_id); ?>">
        <input type="hidden" name="module_id" value="<?php echo htmlspecialchars($module_id); ?>">
        <?php
        $q_number = 1;
        while ($question = mysqli_fetch_assoc($questions_result)) {
            echo "
            <div class='table-container'>
            <table class='table table-borderless table-hover'>
              <thead>
                <th>
                  <input type='hidden' name='questions[]' value='{$question['id']}'>
                  <p>{$q_number} : " . htmlspecialchars($question['question']) . "</p>
                </th>
              </thead>
              <tr>
                <td>
                <label><input type='radio' name='answers[{$question['id']}]' value='a'> " . htmlspecialchars($question['option_a']) . "</label>
                </td>
              </tr>
              <tr>
                <td>
                <label><input type='radio' name='answers[{$question['id']}]' value='b'> " . htmlspecialchars($question['option_b']) . "</label>
                </td>
              </tr>
              <tr>
                <td>
                <label><input type='radio' name='answers[{$question['id']}]' value='c'> " . htmlspecialchars($question['option_c']) . "</label>
                </td>
              </tr>
              <tr>
                <td>
                <label><input type='radio' name='answers[{$question['id']}]' value='d'> " . htmlspecialchars($question['option_d']) . "</label>
                </td>
              </tr>
            </table>";
            $q_number++;
        }
        ?>
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../../javascript/script.js"></script> 
</body>
</html>
