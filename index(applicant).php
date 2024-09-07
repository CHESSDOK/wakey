<!DOCTYPE html>
<html lang="en">
<?php
include 'php/conn_db.php';
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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
        <div class="logo">
            <img src="img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>
        <label class="burger" for="burger">
            <input type="checkbox" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="html/applicant/applicant.php">Applicant</a></li>
            <li><a href="html/applicant/training_list.php">training</a></li>
            <li><a href="html/applicant/ofw_home.php">OFW</a></li>
            <li><a href="html/about.php">About Us</a></li>
            <li><a href="html/contact.php">Contact Us</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($row['username']); ?> </button>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <p> <span class="label1">PESO</span><span class="label2">Los Baños</span><br />
            <span class="label3">Public Employment Service Office</span><br>
            <span class="label4"> JOB PORTAL &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><br>
            <span class="label5">YOUR <span style="color: #3D93D3; font-weight: bold">NEW CAREER </span> STARTS HERE!</span></p>
            <button class="label6">Find Job</button>
            <p><span class="label7"> Available in one roof the various employment promotion, manpower programs, and services of the DOLE </span><br>
                <span class="label8">and other government agencies to enable all types of clientele to know more about them and seek </span> <br>
                <span class="label9"></span>specific assistance they require.</span></p>
        </div>
    </div>
    <script>
    document.getElementById("emprof").addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior

      // Change the URL after the transition ends
      setTimeout(function () {
        window.location.href = "html/applicant/approf.php";
      }, 300); // Adjust the delay according to your transition duration

      // Adding the class to initiate the fade-in and slide-up animation
      document.body.classList.add('fade-in');
    });
  </script> 
   <script src="javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->
</body>
</html>
