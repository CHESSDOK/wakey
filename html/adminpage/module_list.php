<?php
include 'conn_db.php';
session_start();
$admin = $_SESSION['username'];
// Fetch all employers
$course_id = $_GET['course_id'];
$sql = "SELECT * FROM modules WHERE course_id = $course_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - module list</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/admin_course.css">
    <link rel="stylesheet" href="../../css/nav_float.css">
</head>
<body>

<nav>
    <div class="logo">
        <img src="../../img/logo_peso.png" alt="Logo">
        <a href="#"> PESO-lb.ph</a>
    </div>

    <header>
      <h1 class="ofw-h1">Module Contents</h1>
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
                <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="employer_list.php" class="nav-link">Employer List</a></td></tr>
                <tr><td><a href="#" class="active nav-link">Course List</a></td></tr>
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
    <li class="breadcrumb-item active" aria-current="page">Module List</li>
  </ol>
</nav>

<div class="table-container">
    <table class="table table-borderless table-hover">
        <thead>
            <th>Module Title</th>
            <th colspan="4">Actions</th>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['module_name']) . "</td>
                        <td><a class='docu openFileBtn' href='#' data-module-id=" . htmlspecialchars($row['id']) . "
                            data-course-id=" . htmlspecialchars($course_id) . ">Upload Video</a></td>
                        <td><a class='docu openQuizBtn' href='#' data-secmodule-id=" . htmlspecialchars($row['id']) . "
                            data-seccourse-id=" . htmlspecialchars($course_id) . ">Quiz Maker</a></td>
                        <td><a class='docu' href='quiz_list.php?modules_id=" . htmlspecialchars($row['id']) . "&course_id=" . $course_id . "'>Quiz List</a></td>
                        <td><a class='docu openContentBtn' href='#' data-thirdmodule-id=".htmlspecialchars($row['id']).">Contents</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No modules found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<!-- upload file -->
    <div id="fileModal" class="modal modal-container">
        <div class="modal-content">
            <span class="btn-close closBtn closeBtn">&times;</span>
            <h2>Upload Material</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="mod_id" id="moduleId">
              <input type="hidden" name="course_id" id="courseId">

                <table class="table table-borderless tbl_module">
                  <tr>
                    <td>
                      <label class="upload-label" for="des">Description:</label>
                      <textarea class="form-control" type="text" placeholder="Leave a description here" name="desc" id="desc"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <label class="upload-label" for="files">Select files:</label>
                    <input class="form-control" type="file" name="files[]" id="files" multiple>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <label class="upload-label" for="link">Video:</label>
                    <input class="form-control" type="url" placeholder="Leave a url here" name="link" id="link">
                    </td>
                  </tr>
                </table>
            <input class="btn btn-primary" type="submit" name="submit" value="Upload">
            </form>
        </div>
    </div>

<!-- quiz maker file -->
    <div id="quizModal" class="modal modal-container">
        <div class="modal-content">
            <span class="btn-close closBtn closeBtn">&times;</span>
            <h2>Quiz Maker</h2>
            <form class="form" action="quiz_upload.php" method="post">
              <input type="hidden" name="secmodule_id" id="secmoduleId">
              <input type="hidden" name="seccourse_id" id="seccourseId">

            <table class="table table-borderless tbl_module">
              <tr>
                <td>
                  <label class="title upload-label">EXAM MAKER</label>
                </td>
              </tr>
              <tr>
                <td>
                  <label class="subtitle upload-label">Make questions to challenge the users</label>
                </td>
              </tr>
              <tr>
                <td>
                    <input type="text" class="input" name="name" placeholder="Enter Exam Title" required>
                </td>
              </tr>
              <tr>
                <td>
                        <input type="number" class="input" name="total" placeholder="Enter total number of questions" required>
                        <input type="number" class="input" name="corr" placeholder="Enter points for each question" required>
                        <input type="number" class="input" name="wrong" placeholder="Enter deduction for wrong answer" required>
                        <input type="text" class="input" name="tag" placeholder="Enter a tag for your exam" required>
                
                </tr>
                </table>
                <input type="submit" name="submit" value="generate">
            </form>
        </div>
    </div>

<!-- content file -->
        <div id="contentModal" class="modal modal-container">
            <div class="modal-content">
                <span class="btn-close closBtn closeBtn">&times;</span>
                <div id="contentModuleContent">
                    <!-- Module content will be dynamically loaded here -->
                </div>
            </div>
        </div>


<script>
    const filemodal = document.getElementById('fileModal');
    const quizmodal = document.getElementById('quizModal');
    const closeBtn = document.querySelector('.closeBtn');
    const moduleIdField = document.getElementById('moduleId');
    const courseIdField = document.getElementById('courseId');
    const secmoduleIdField = document.getElementById('secmoduleId');
    const seccourseIdField = document.getElementById('seccourseId');

        // Event delegation: Listen to clicks on the document for elements with the 'openFileBtn' class
        document.addEventListener('click', function(event) {
            //file
            if (event.target.classList.contains('openFileBtn')) {
                const moduleId = event.target.getAttribute('data-module-id');
                const courseId = event.target.getAttribute('data-course-id');
                
                // Set the module ID in the hidden field
                moduleIdField.value = moduleId;
                courseIdField.value = courseId;

                // Open the modal
                filemodal.style.display = 'flex';
            }
            //quiz
            if (event.target.classList.contains('openQuizBtn')) {
                const secmoduleId = event.target.getAttribute('data-secmodule-id');
                const seccourseId = event.target.getAttribute('data-seccourse-id');
                
                // Set the module ID in the hidden field
                secmoduleIdField.value = secmoduleId;
                seccourseIdField.value = seccourseId;

                // Open the modal
                quizmodal.style.display = 'flex';
            }
        });

    //cotent module
    // Close modal when 'x' is clicked
    closeBtn.addEventListener('click', function() {
        filemodal.style.display = 'none';
        quizmodal.style.display = 'none';
    });

    // Close modal when clicked outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target === filemodal) {
            filemodal.style.display = 'none';
        }
        if (event.target === quizmodal) {
            quizmodal.style.display = 'none';
        }
    });

   // Get modal and button elements for viewing profile
        const contentModal = document.getElementById('contentModal');
        const thridcloseModuleBtn = document.querySelector('.thirdcloseBtn');

        // Open profile modal and load data via AJAX
        $(document).on('click', '.openContentBtn', function(e) {
            e.preventDefault();
            const moduleId = $(this).data('thirdmodule-id');

            $.ajax({
                url: 'module_content.php',
                method: 'GET',
                data: { module_id: moduleId },
                success: function(response) {
                    $('#contentModuleContent').html(response);
                    contentModal.style.display = 'flex';
                }
            });
        });

        // Close profile modal when 'x' is clicked
        thridcloseModuleBtn.addEventListener('click', function() {
            contentModal.style.display = 'none';
        });

        // Close profile modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === contentModal) {
                contentModal.style.display = 'none';
            }
        });
    </script>

    <script src="../../javascript/a_profile.js"></script> 
    <script src="../../javascript/script.js"></script> 

</body>
</html>
