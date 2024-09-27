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
  </head>
<body>
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

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
                <tr><td><a href="#" class="active nav-link">Home</a></td></tr>
                <tr><td><a href="../../html/employer/job_creat.php" class="nav-link">Post Job</a></td></tr>
                <tr><td><a href="../../html/employer/job_list.php" class="nav-link">Job List</a></td></tr>
                <tr><td><a href="../../html/about.html" class="nav-link">About Us</a></td></tr>
                <tr><td><a href="../../html/contact.html" class="nav-link">Contact Us</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<form action="../../php/employer/documents_process.php" method="post" enctype="multipart/form-data">
        <label for="document_name">Document Name:</label>
        <input type="text" name="document_name" id="document_name" required><br>

        <label for="document">Upload Document:</label>
        <input type="file" name="document" id="document" required><br>

        <input type="submit" value="Upload">
    </form>

    <form action="../../php/employer/employer_prof_process.php" method="post">
        <div id="companyField">
            <label for="company_name">ID:</label>

            <label for="profile_image">Select Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" required> <br>

            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" value="<?php echo htmlspecialchars($row['company_name'] ?? ''); ?>"><br>

            <label for="company_add">Company Address:</label>
            <input type="text" name="company_add" id="company_add" value="<?php echo htmlspecialchars($row['company_address'] ?? ''); ?>"><br>

            <label for="tel_num">Company Telephone Number:</label>
            <input type="text" name="tel_num" id="tel_num" value="<?php echo htmlspecialchars($row['tel_num'] ?? ''); ?>"><br>

            <label for="president">Company President:</label>
            <input type="text" name="president" id="president" value="<?php echo htmlspecialchars($row['president'] ?? ''); ?>"><br>

            <label for="HR">HR Manager:</label>
            <input type="text" name="HR" id="HR" value="<?php echo htmlspecialchars($row['HR'] ?? ''); ?>"><br>

            <label for="company_mail">Company Email:</label>
            <input type="text" name="company_mail" id="company_mail" value="<?php echo htmlspecialchars($row['company_mail'] ?? ''); ?>"><br>

            <label for="HR_mail">HR Official Email:</label>
            <input type="text" name="HR_mail" id="HR_mail" value="<?php echo htmlspecialchars($row['HR_mail'] ?? ''); ?>"><br>
        </div>

        <input type="submit" value="Update">
    </form>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../../javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->

</body>
</html>