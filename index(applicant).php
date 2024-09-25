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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/notif.css">
</head>
<body>
<nav>
    <div class="logo">
        <img src="img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon" data-bs-toggle="popover" data-bs-placement="bottom">
            <img id="preview" src="img/user-placeholder.png<?php echo !empty($row['photo']) ? $row['photo'] : 'img/user-placeholder.png'; ?>" alt="Profile Image" class="circular--square">
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
                <tr><td><a href="#" class="active nav-link">Home</a></td></tr>
                <tr><td><a href="html/applicant/applicant.php" class="nav-link">Applicant</a></td></tr>
                <tr><td><a href="html/applicant/training_list.php" class="nav-link">Training</a></td></tr>
                <tr><td><a href="html/applicant/ofw_home.php" class="nav-link">OFW</a></td></tr>
                <tr><td><a href="html/about.php" class="nav-link">About Us</a></td></tr>
                <tr><td><a href="html/contact.php" class="nav-link">Contact Us</a></td></tr>
            </table>
        </div>
    </div>
</nav>
<table>
 <td class="whole">
    <table >
    <tr>
      <td class="container_whole" colspan="2">
        <label class="lbl_1">PESO</label>
        <label class="lbl_2">Los Baños</label>
      </td>
    </tr>
    <tr>
      <td class="container_whole" colspan="2">
        <label class="lbl_3">Public Employment Service Office</label>
      </td>
    </tr>
    <tr>
      <td class="container_whole" colspan="2">
        <label class="lbl_4">JOB PORTAL</label>
      </td>
    </tr>
    <tr>
      <td class="container_whole" colspan="2">
        <label class="lbl_5">YOUR</label>
        <label class="lbl_6">NEW CAREER</label>
        <label class="lbl_7">STARTS HERE!</label>
      </td>
    </tr>
    <tr>
      <td class="container_whole">
        <button class="btn btn-primary lbl_8">Find Job</button>
      </td>
    </tr>
    <tr>
      <td class="container_whole" colspan="2">
        <textarea readonly>
            Available in one roof the various employment promotion, manpower programs, 
            and services of the DOLE and other government agencies to enable all types 
            of clientele to know more about them and seek specific assistance they require.
        </textarea>
      </td>
    </tr>
    </table>
 </td>
</table>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->
</body>
</html>
