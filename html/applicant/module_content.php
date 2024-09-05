<?php
include '../../php/conn_db.php';
session_start();
$user_id = $_GET['user_id'];
// Fetch all employers
$module_id = $_GET['modules_id'];
$sql = "SELECT * FROM module_content WHERE modules_id = $module_id ";
$result = $conn->query($sql);



?>
<!DOCTYPE html>
<html>
<head>
    <title>Employer List</title>
    
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
        <h1 class="h1">Content</h1>
    </header>
    <table border="1">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["description"] . "</td>
                        <td><a href='" . $row["video"] . "' target='_blank'>View Video</a></td>
                        <td><a href='" . $row["file_path"] . "' target='_blank'>Open File</a></td>
                        <td><a href='quiz_list.php?modules_id=" . $row["id"] ."'>take quiz</a></td>

                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
        <div class="btn-container">
                <a class="btn_back" href="modules_list.php?user_id=<?php echo $user_id; ?>&course_id=<?php echo $module_id; ?>">
                <i class="fas fa-caret-left"></i> Return
            </a>
        </div>
    <script src="../../javascript/script.js"></script> 
</body>
</html>
