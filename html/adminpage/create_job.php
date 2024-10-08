<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['id'];

$sql = "SELECT * FROM job_postings WHERE admin_id = $admin";
$result = $conn->query($sql);
?>

<html lang="en">
<head>
    <title>Admin Post Job</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modal-form.css"> 
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/admin_employer.css">
</head>
<body>

<nav>
        <div class="logo">
            <img src="../../img/logo_peso.png" alt="Logo">
            <a href="#"> PESO-lb.ph</a>
        </div>

        <header>
            <h1 class="h1">Admin Job Posting</h1>
        </header>

        <div class="profile-icons">
            <div class="notif-icon" data-bs-toggle="popover" data-bs-content="#" data-bs-placement="bottom">
                <img id="#" src="../../img/notif.png" alt="Profile Picture" class="rounded-circle">
            </div>
            
            <div class="profile-icon-employer" data-bs-toggle="popover" data-bs-placement="bottom">
            <?php if (!empty($row['photo'])): ?>
                <img id="preview" src="php/employer/images/<?php echo $row['photo']; ?>" alt="Profile Image" class="circular--square">
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
                    <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                    <tr><td><a href="employer_list.php" class="active nav-link">Employer List</a></td></tr>
                    <tr><td><a href="course_list.php" class="nav-link">Course List</a></td></tr>
                    <tr><td><a href="ofw_case.php" class="nav-link">OFW Cases</a></td></tr>
                    <tr><td><a href="user_master_list.php" class="nav-link">User List</a></td></tr>
                </table>
            </div>
        </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
  <li class="breadcrumb-item"><a href="employer_list.php" >Employer List</a></li>
  <li class="breadcrumb-item active" aria-current="page">Post Job</li>
  </ol>
</nav>

<div class="table-containers">
    <div class="row align-items-start">
        <div class="col-auto">
            <button class="btn btn-primary openCourseBtn" id="openCourseBtn">Create Job</button>
        </div>
        <div class="col">
            <table class="table table-borderless table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Job Description</th>
                        <th>Specialization</th>
                        <th>Vacant</th>
                        <th>Status</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <form action='update_jobs.php' method='post'>
                                        <input type='hidden' name='job_id' value='" . $row['j_id'] . "'>
                                        <td><input type='text' class='form-control custom-input-size' name='jtitle' value='" . htmlspecialchars($row['job_title']) . "'></td>
                                        <td><input type='text' class='form-control custom-input-size' name='desc' value='" . htmlspecialchars($row['job_description']) . "'></td>
                                        <td><input type='text' class='form-control custom-input-size' name='spe' value='" . htmlspecialchars($row['specialization']) . "'></td>
                                        <td><input type='number' class='form-control custom-input-size value-display mt-1' name='vacant' value='" . $row['vacant'] . "'></td>
                                        <td><input type='number' class='form-control custom-input-size value-display mt-1' name='act' value='" . $row['is_active'] . "'></td>

                                        <td>
                                            <button type='submit' class='btn btn-success custom-input-size mt-1'>Update</button>
                                        </td>
                                    </form>
                                    <td>
                                        <a href='applicant_list.php?job_id=" . $row['j_id'] . "' class='btn btn-primary custom-input-size mt-1'>Applicants</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No Job found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


    <div id="jobModal" class="modal modal-container-upload">
        <div class="modal-content">
            <span class="btn-close closBtn seccloseBtn">&times;</span>
            <h2>Upload Job Post</h2>
            <div id="uploadJobContent">
                <!-- Profile details will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../javascript/script.js"></script> <!-- You can link your JavaScript file here if needed -->
    <script>
            const jobModal = document.getElementById('jobModal');
            const seccloseModuleBtn = document.querySelector('.seccloseBtn');
        
            // Open profile modal and load data via AJAX
            $(document).on('click', '#openCourseBtn', function(e) {
                e.preventDefault();

                
                $.ajax({
                    url: 'upload_job.php',
                    method: 'GET',
                    success: function(response) {
                        $('#uploadJobContent').html(response);
                        jobModal.style.display = 'flex';
                    }
                });
            });
        
            // Close profile modal when 'x' is clicked
            seccloseModuleBtn.addEventListener('click', function() {
                jobModal.style.display = 'none';
            });
        
            // Close profile modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === jobModal) {
                    jobModal.style.display = 'none';
                }
            });
    </script>
</body>
</html>