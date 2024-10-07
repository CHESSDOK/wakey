<?php
session_start();
include 'conn_db.php';  // Include database connection

// Check if admin is logged in
$admin = $_SESSION['username'];

// Fetch all cases
$sql = "SELECT c.*, ap.*
        FROM cases c
        JOIN applicant_profile ap ON c.user_id = ap.user_id
       ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cases</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/admin_ofw.css">
    <link rel="stylesheet" href="../../css/nav_float.css">
</head>
<body>

<!-- Navigation -->
<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
      <h1 class="ofw-h1">OFW Filed Cases</h1>
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

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="menu">
                <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="create_job.php" class="nav-link">Post Job</a></td></tr>
                <tr><td><a href="employer_list.php" class="nav-link">Employer List</a></td></tr>
                <tr><td><a href="course_list.php" class="nav-link">Course List</a></td></tr>
                <tr><td><a href="#" class="active nav-link">OFW Cases</a></td></tr>
                <tr><td><a href="user_master_list.php" class="nav-link">User List</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">OFW Cases</li>
  </ol>
</nav>

<div class="table-containers grid gap-3">
    <table class="table-containrs">
        <tr>
            <td>
                <a class="btn btn-primary" href="user_chat.php">View Inquiries</a>
            </td>
        </tr>
        <tr>
            <td>
                <a class="btn btn-primary" href="create_survey.php">Create Survey</a>
            </td>
        </tr>
    </table>

    <div class="table-container">
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Agency</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Status update</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                            echo "<tr>
                                <td>".$full_name."</td>
                                <td>".$row['contact_number']."</td>
                                <td>".$row['local_agency_name']."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['status']."</td>
                                <td> <a class='docu' href='module_list.php?course_id=" . $row["id"] . "'>update</a> </td>
                                 </tr>";
                                } 
                        } else {
                            echo "<tr><td colspan='6'> no case file found</td></tr>";
                        }
                         $conn->close();
                ?>
                </tbody>
            </table>  
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/a_profile.js"></script> 
    
    <script src="../../javascript/script.js"></script> 
</body>
</html>