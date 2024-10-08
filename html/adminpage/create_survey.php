<?php
    include 'conn_db.php';  // Database connection

    // Insert survey question
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $questions = $_POST['question'];
        $category = $_POST['category'];

        // Prepared statement for security
        $stmt = $conn->prepare("INSERT INTO survey_form (question, category) VALUES (?, ?)");
        $stmt->bind_param("ss", $questions, $category);

        if ($stmt->execute() === TRUE) {
            header("Location: create_survey.php");
            exit();  // Important to stop further script execution after redirect
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    // Fetch existing survey questions
    $sql_new = "SELECT * FROM survey_form ORDER BY category";
    $result = $conn->query($sql_new);

    // Initialize variable to track the current category
    $current_category = '';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
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
      <h1 class="ofw-h1">OFW Survey Creator</h1>
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
            <button type="button" class="btn-close offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="menu">
            <tr><td><a href="admin_home.php" class="nav-link">Home</a></td></tr>
                <tr><td><a href="employer_list.php" class="nav-link">Employer List</a></td></tr>
                <tr><td><a href="course_list.php" class="nav-link">Course List</a></td></tr>
                <tr><td><a href="#" class="active nav-link">OFW Cases</a></td></tr>
            </table>
        </div>
    </div>
</nav>

<nav class="bcrumb-container" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
    <li class="breadcrumb-item"><a href="ofw_case.php" >OFW Cases</a></li>
    <li class="breadcrumb-item active" aria-current="page">Survey Creator</li>
  </ol>
</nav>

<div class="table-containers grid gap-3">
    <form action="create_survey.php" method="POST">
        <table class="table table-borderless tbl-question" style="background-color:transparent;">
        <thead>
            <th>Survey Question</th>
        </thead>
        <tbody class="grid gap-3 row-gap-0">
            <tr>
            <td>
                <input class="form-control" type="text" name="question" placeholder="Enter Survey Question" value="">
            </td>
            </tr>
            <tr>
            <td>
                <input class="form-control" type="text" name="category" placeholder="Survey Category"  value="">
            </td>
            </tr>
            <tr>
            <td>
                <input class="btn btn-primary" style="display:flex; position:flex-start;" type="submit" value="Submit">
            </td>
            </tr>
        </tbody>
        </table>
    </form>

  <table class="table table-borderless table-hover tbl-question ">
    <?php
    if ($result->num_rows > 0) {
        $current_category = ''; // To track the current category
        while ($row = $result->fetch_assoc()) {
            // Check if we are in a new category
            if ($current_category != $row['category']) {
                // If it's a new category, print it as a header
                echo "<tr><td colspan='3'><strong>Category: " . $row['category'] . "</strong></td></tr>";
                // Update current category tracker
                $current_category = $row['category'];
            }

            // Print each question under its category
            echo "<tr>
                    <form action='update_survey.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <td><input class='form-control' type='text' name='question' value='" . $row["question"] . "'></td>
                    <td><input class='form-control' type='text' name='category' value='" . $row["category"] . "'></td>
                    <td><input class='btn btn-primary mt-2' type='submit' value='Update'></td>
                    <td><a href='delete_survey.php?survey_id=".$row["id"]."'>DELETE</a></td>
                    </form>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No survey found</td></tr>";
    }
    ?>
  </table>
</div>

<!-- ####################################################### answer checking ###################################################################### -->
<table border="1">
    <tr>
        <th>User ID</th>
        <th>Full Name</th>
    </tr>
    <?php
    // Fetch unique user response data (grouped by user_id)
    $sql_new1 = "SELECT survey_reponse.user_id, 
                    MAX(applicant_profile.first_name) AS first_name, 
                    MAX(applicant_profile.middle_name) AS middle_name, 
                    MAX(applicant_profile.last_name) AS last_name
             FROM survey_reponse
             INNER JOIN applicant_profile ON survey_reponse.user_id = applicant_profile.user_id
             GROUP BY survey_reponse.user_id";
              // Ensures only unique user_id

    $result_new = $conn->query($sql_new1);

    if ($result_new->num_rows > 0) {
        while ($row = $result_new->fetch_assoc()) {
            $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
            echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $full_name . "</td>
                    <td> <a class='docu openSurveyBtn' href='#' data-user-id=".htmlspecialchars($row['user_id'])."> check </a> </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No users found</td></tr>";
    }

    // Close connection at the very end of the script
    $conn->close();
    ?>
</table>

<!-- employer list -->
<div id="surveyModal" class="modal">
            <div class="modal-content">
                <span class="closeBtn">&times;</span>
                <div id="surveyModuleContent">
                    <!-- Module content will be dynamically loaded here -->
                </div>
            </div>
        </div>

    <script>  const surveyModal = document.getElementById('surveyModal');
        const closeModuleBtn = document.querySelector('.closeBtn');
        // Open profile modal and load data via AJAX
        $(document).on('click', '.openSurveyBtn', function(e) {
            e.preventDefault();
            const userId = $(this).data('user-id');

            $.ajax({
                url: 'user_response.php',
                method: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    $('#surveyModuleContent').html(response);
                    surveyModal.style.display = 'flex';
                }
            });
        });

        // Close profile modal when 'x' is clicked
        closeModuleBtn.addEventListener('click', function() {
            surveyModal.style.display = 'none';
        });

        // Close profile modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === surveyModal) {
                surveyModal.style.display = 'none';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/a_profile.js"></script>
    <script src="../../javascript/script.js"></script> 
</body>
</html>
