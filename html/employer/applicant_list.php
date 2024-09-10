<?php
include '../../php/conn_db.php';

// Fetch all employers
$sql = "SELECT * FROM applications";
$result = $conn->query($sql);

//$sql = "SELECT * FROM register WHERE id = ?";
///$stmt = $conn->prepare($sql);
//$stmt->bind_param("i", $userId);
//$stmt->execute();
//$res = $stmt->get_result();

//if (!$res) {
//    die("Invalid query: " . $conn->error); 
//}
//
//$row = $res->fetch_assoc();
//if (!$row) {
//    die("User not found.");
//}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Employer List</title>
  <link rel="stylesheet" href="../../css/nav_float.css">
</head>
<body>
    <!-- Navigation -->
<nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>
        <label class="burger" for="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="../../index(applicant).php">Home</a></li>
            <li><a href="applicant.php" >Applicant</a></li>
            <li><a href="" class="active">Training</a></li>
            <li><a href="ofw_home.php">OFW</a></li>
            <li><a href="../../html/about.php" >About Us</a></li>
            <li><a href="../../html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>
    <header>
        <h1 class="h1">Employer Dashboard</h1>
    </header>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td><a href='applicant_profile.php?user_id=" . $row["applicant_id"] . "'>View</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employers found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    
    <script src="../javascript/script.js"></script>
</body>
</html>
