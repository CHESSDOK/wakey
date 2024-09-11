<?php
include '../../php/conn_db.php';
session_start();
$userId = $_SESSION['id'];
$user_id = $_GET['user_id'];
// Fetch all employers
$module_id = $_GET['course_id'];
$sql = "SELECT * FROM modules WHERE course_id = $module_id ";
$result = $conn->query($sql);

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
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Page</title>
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/Module.css">

<!--arrrow icon-->
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
            <li><a href="applicant.php" >Applicant</a></li>
            <li><a href="" class="active">Training</a></li>
            <li><a href="#">OFW</a></li>
            <li><a href="../../html/about.php" >About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>
    <header>
        <h1 class="h1">Module List</h1>
    </header>
    
    <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table border='1'>";
                echo "<tr>
                        <td class='img_cell'><img class='icon' src='../../img/file_icon.png' alt='Logo'></td>
                        <td class='num_cell'> <p> " . $row["id"] . " </td>
                        <td class='title_cell'> <p> " . $row["module_name"] . " </td>
                        <td class='btn_cell'>
                            <a class='btn' href='module_content.php?user_id=". $user_id ." 
                            &modules_id=". $row["id"] ."&course_id=". $module_id ."& module_name=".$row["module_name"]."'>view more <i class='fas fa-chevron-right'></i></a>
                        </td>
                    </tr>";
                echo "</table>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>

        <div class="btn-container">
            <a class="btn_back" onclick="window.location.href='training_list.php'">
                <i class="fas fa-caret-left"></i> Return
            </a>
        </div>

    <script src="../../javascript/script.js"></script> 
</body>
</html>
