<?php
include 'conn_db.php';

$user_id = $_GET['user_id'];
$sql = "SELECT * FROM courses WHERE id = $user_id";  // Replace `1` with the specific course ID if needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the course data
    $row = $result->fetch_assoc();
    $course_id = $row["id"];
    $module_count = $row["module_count"];
} else {
    echo "No courses found.";
    exit; // Stop script execution if no course is found
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="../../css/admin_course.css">
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
      <h1 class="ofw-h1">Course Module</h1>
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
                <tr><td><a href="#" class="nav-link">Home</a></td></tr>
                <tr><td><a href="employer_list.php" class="nav-link">Employer List</a></td></tr>
                <tr><td><a href="course_list.php" class="active nav-link">Course List</a></td></tr>
                <tr><td><a href="ofw_case.php" class="nav-link">OFW Cases</a></td></tr>
                <tr><td><a href="create_survey.php" class="nav-link">OFW Survey</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb"> 
    <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
    <li class="breadcrumb-item"><a href="course_list.php" >Courses</a></li>
    <li class="breadcrumb-item active" aria-current="page">Module Labels</li>
  </ol>
</nav>


<form method="POST" action="save_modules.php" enctype="multipart/form-data">
<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
<input type="hidden" name="course_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="module_count" value="<?php echo $module_count; ?>">

<div class="upl-container">
    <form method="post" action="your-action-url"> <!-- Specify your action URL here -->
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>List of Modules</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= $module_count; $i++): ?>
                    <tr>
                        <td>
                            <input class="form-control upl-input" type="text" id="module_name_<?php echo $i; ?>" 
                            name="module_name_<?php echo $i; ?>" placeholder="Module <?php echo $i; ?>" required>
                        </td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <input class="btn btn-primary mt-3" type="submit" value="Save Modules"> <!-- Added mt-3 for spacing -->
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/a_profile.js"></script> 
    
    <script src="../../javascript/script.js"></script> 
</body>
</html>

