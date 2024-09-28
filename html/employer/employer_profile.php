<?php
// Start the session and check if the user is logged in
function checkSession() {
    session_start(); // Start the session

    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: html/login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession(); // Call the function and store the returned user ID

// Assuming $conn is your valid database connection
include '../../php/conn_db.php'; // Include your database connection script

$sql = "SELECT * FROM empyers WHERE id = ?";
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../css/nav_float.css">
  <link rel="stylesheet" href="../../css/employer.css">
  </head>
<body>
<<<<<<< HEAD
    <form action="../../php/employer/employer_prof_process.php" method="post" enctype="multipart/form-data">
        <div id="companyField">
            <label for="company_name">ID:</label>
=======
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>
>>>>>>> 138d102436fed8e7277b1d09b30b23ad86f28769

    <header>
        <h1 class="h1">Profile</h1>
    </header>

    <div class="profile-icons">
        <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
            <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
        </div>
        
        <div class="profile-icon" data-bs-toggle="popover" data-bs-placement="bottom">
    <?php if (!empty($row['photo'])): ?>
        <img id="preview" src="php/applicant/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
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
                <tr><td><a href="../../html/employer/employer_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="../../html/employer/job_creat.php" class="nav-link">Post Job</a></td></tr>
                <tr><td><a href="../../html/employer/job_list.php" class="nav-link">Job List</a></td></tr>
                <tr><td><a href="../../html/about.html" class="nav-link">About Us</a></td></tr>
                <tr><td><a href="../../html/contact.html" class="nav-link">Contact Us</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../../html/employer/employer_home.php" >Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
  </ol>
</nav>

<div class="ep-container">
<form action="../../php/employer/employer_prof_process.php" method="post">
<table> 
<h1 class="h1">Company Info</h1>
 <tr>
   <td colspan="2">
    <label for="profile_image" class="form-label">Select Profile Image:</label>
    <input type="file"  class="form-control" name="profile_image" id="profile_image" accept="image/*" required>   
   </td>
 </tr>
 <tr>
   <td>
    <label for="company_name" class="form-label">Company Name:</label>
    <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo htmlspecialchars($row['company_name'] ?? ''); ?>">
   </td>
   <td>
    <label for="president" class="form-label">Company President:</label>
    <input type="text" class="form-control" name="president" id="president" value="<?php echo htmlspecialchars($row['president'] ?? ''); ?>">
   </td>
 </tr>
 <tr>
   <td colspan="2">
    <label for="company_add" class="form-label">Company Address:</label>
    <input type="text" class="form-control" name="company_add" id="company_add" value="<?php echo htmlspecialchars($row['company_address'] ?? ''); ?>">
   </td>
 </tr>
 <tr>
   <td>
    <label for="HR" class="form-label">HR Manager:</label>
    <input type="text" class="form-control" name="HR" id="HR" value="<?php echo htmlspecialchars($row['HR'] ?? ''); ?>">
   </td>
   <td>
    <label for="HR_mail" class="form-label">HR Official Email:</label>
    <input type="text" class="form-control" name="HR_mail" id="HR_mail" value="<?php echo htmlspecialchars($row['HR_mail'] ?? ''); ?>">
   </td>
 </tr>
 <tr>
   
   <td>
    <label for="tel_num" class="form-label">Company Telephone Number:</label>
    <input type="text" class="form-control" name="tel_num" id="tel_num" value="<?php echo htmlspecialchars($row['tel_num'] ?? ''); ?>">
   </td>
   <td>
    <label for="company_mail" class="form-label">Company Email:</label>
    <input type="text" class="form-control" name="company_mail" id="company_mail" value="<?php echo htmlspecialchars($row['company_mail'] ?? ''); ?>">
   </td>
 </tr>
 <tr>
   <td>
    <input class="btn btn-primary" type="submit" value="Update">
   </td>
 </tr>
</table>
</form>
</div>

<div class="ep-container">
<form action="../../php/employer/documents_process.php" method="post" enctype="multipart/form-data">
<table>
<h1 class="h1">Company Documents</h1>
 <tr>
   <td>
    <label for="document_name" class="form-label">Document Name:</label>
    <input type="text" class="form-control" name="document_name" id="document_name" >
   </td>
   <td>
    <label for="document" class="form-label">Upload Document:</label>
    <input type="file" class="form-control" name="document" id="document" >
   </td>
 </tr>
 <tr>
   <td>
    <input class="btn btn-primary" type="submit" value="Upload">
   </td>
 </tr>
</table>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../../javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->

</body>
</html>