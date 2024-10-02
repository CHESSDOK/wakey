<?php
  include '../../php/conn_db.php';
  function checkSession() {
      session_start(); // Start the session

      // Check if the session variable 'id' is set
      if (!isset($_SESSION['id'])) {
          // Redirect to login page if session not found
          header("Location: ../login.html");
          exit();
      } else {
          // If session exists, store the session data in a variable
          return $_SESSION['id'];
      }
  }
  $userId = checkSession();

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFW Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../css/modal-form.css">
    <link rel="stylesheet" href="../../css/nav_float.css">
    <link rel="stylesheet" href="../../css/ofw_form.css">
</head>
<body>
  <!-- Navigation -->
  <nav>
      <div class="logo">
          <img src="../../img/logo_peso.png" alt="Logo">
          <a href="#"> PESO-lb.ph</a>
      </div>

      <header>
          <h1 class="h1">File a Case</h1>
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
                    <tr><td><a href="../../index(applicant).php" class="nav-link">Home</a></td></tr>
                    <tr><td><a href="applicant.php" class="nav-link">Applicant</a></td></tr>
                    <tr><td><a href="training_list.php" class="nav-link">Training</a></td></tr>
                    <tr><td><a href="#" class="active nav-link">OFW</a></td></tr>
                    <tr><td><a href="../../html/about.php" class="nav-link">About Us</a></td></tr>
                    <tr><td><a href="../../html/contact.php" class="nav-link">Contact Us</a></td></tr>
                </table>
            </div>
        </div>
  </nav> 

  <nav class="bcrumb-container" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../../index(applicant).php" >Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">OFW Form</li>
    </ol>
  </nav>



  <!-- Offcanvas Component -->
  <div class="form-container">
    <table class="table table-borderless">
        <tr>
            <th class="text-center">Question</th>
            <th class="text-center">Never</th>
            <th class="text-center">Often</th>
            <th class="text-center">Sometimes</th>
            <th class="text-center">Always</th>
        </tr>

        <form action='../../php/applicant/survey_reponse.php' method='POST'>
    <?php
        $sql = "SELECT * FROM survey_form ORDER BY category";
        $result = $conn->query($sql);
        
        // Initialize variable to track the current category
        $current_category = '';

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              // Fetch the user's previous response for the current survey question
              $survey_id = $row['id'];
              $response_sql = "SELECT reponse FROM survey_reponse WHERE user_id = $userId AND survey_id = $survey_id";
              $response_result = $conn->query($response_sql);
              $previous_response = '';
      
              // Get the previous response if it exists
              if ($response_result->num_rows > 0) {
                  $response_row = $response_result->fetch_assoc();
                  $previous_response = $response_row['reponse'];
              }
      
              // Check if we are in a new category
              if ($current_category != $row['category']) {
                  // If it's a new category, print it as a heading row
                  echo "<tr><td colspan='5'><strong>Category: " . $row['category'] . "</strong></td></tr>";
                  // Update current category tracker
                  $current_category = $row['category'];
              }
      
              // Print the survey question with radio button options
              echo "<tr>
                      <td>" . $row["question"] . "</td>
                      <input type='hidden' name='survey_ids[]' value='" . $row['id'] . "'>
                      <input type='hidden' name='user_id' value='" . $userId . "'>
                      <td>
                        <div class='form-check d-flex justify-content-center'>
                          <input class='form-check-input' type='radio' name='response" . $row['id'] . "' value='Never' " . ($previous_response == 'Never' ? 'checked' : '') . ">
                        </div>
                      </td>
                      <td>
                        <div class='form-check d-flex justify-content-center'>
                          <input class='form-check-input' type='radio' name='response" . $row['id'] . "' value='Often' " . ($previous_response == 'Often' ? 'checked' : '') . ">
                        </div>
                      </td>
                      <td>
                        <div class='form-check d-flex justify-content-center'>
                          <input class='form-check-input' type='radio' name='response" . $row['id'] . "' value='Sometimes' " . ($previous_response == 'Sometimes' ? 'checked' : '') . ">
                        </div>
                      </td>
                      <td>
                        <div class='form-check d-flex justify-content-center'>
                          <input class='form-check-input' type='radio' name='response" . $row['id'] . "' value='Always' " . ($previous_response == 'Always' ? 'checked' : '') . ">
                        </div>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='5'>No questions found</td></tr>";
      }
      ?>

    <tr>      
        <td>
            <input class="btn btn-primary" type="submit" value="Submit">
        </td>
    </tr>
        </form>
    </table>
  </div>

  <!-- admin chat -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="chatOffcanvas" aria-labelledby="chatOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 id="chatOffcanvasLabel">Chat with Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
              <?php
              $sql = "SELECT m.*, ap.first_name, ap.middle_name, ap.last_name, r.reply, ad.username AS admin_username
              FROM messages m 
              JOIN applicant_profile ap ON m.user_id = ap.user_id
              LEFT JOIN replies r ON m.id = r.message_id
              LEFT JOIN admin_profile ad ON r.admin_id = ad.id
              WHERE m.user_id = '$userId'"; 
              $result = $conn->query($sql);
              echo "
                      <table class='table table-borderless table-hover'>
                                  <thead>
                                      <tr>
                                          <th>Message</th>
                                          <th>Reply</th>
                                          <th></th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                      ";

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                  $message = $row['message'];
                  $reply = $row['reply'];
                  $admin_username = $row['admin_username'];
          
                  echo "<tr>
                          <td>".$full_name." : ".$message."</td></tr>";
          
                  if (!empty($reply)) {
                      echo "<tr><td>".$admin_username." : ".$reply."</td>";
                  } else {
                        echo "<p>No replies found.</p>";
                        }
                    }
                  } else {
                    echo "<tr><td colspan='2'>No messages found</td></tr>";
                }
                echo "</tbody>
                        </table>";
                $conn->close();
    ?>
    <form action="../../php/applicant/send_message.php" method="post">
      <input type="hidden" name="user_id" value="<?php echo $userId ?>">
      <label for="message">Message:</label>
      <textarea id="message" name="message"></textarea><br><br>
      <input type="submit" value="Send Message">
    </form>
    </div>

    <div class="chat-conainer">
      <a class="chat-admin" data-bs-toggle="offcanvas" data-bs-target="#chatOffcanvas">
        <i class="bi bi-chat-dots"></i> Chat with Admin
      </a>
  </div>

  <button id='openCaseBtn' data-ofw-id="<?php echo $userId; ?>" >File Case</button>
  <!-- case -->
    <div id="caseModal" class="modal">
        <div class="modal-content">
            <span class="closeBtn">&times;</span>
            <h2>Interview</h2>
            <form action="../../php/applicant/submit_case.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="userid" id="ofwId" >
                  <label for="title">Case Title:</label>
                  <input type="text" name="title" id="title" required><br><br>

                  <label for="description">Case Description:</label><br>
                  <textarea name="description" id="description" rows="5" required></textarea><br><br>

                  <label for="file">Upload Supporting File:</label>
                  <input type="file" name="file" id="file"><br><br>

                  <button type="submit">Submit Case</button>
            </form>
        </div>
    </div>

  <script>
      const modal = document.getElementById('caseModal');
      const openBtn = document.getElementById('openCaseBtn');
      const closeBtn = document.querySelector('.closeBtn');
      const ofwidField = document.getElementById('ofwId');
      

      // Open modal and set applicant_id in hidden field
      openBtn.addEventListener('click', function() {
        const ofwId = this.getAttribute('data-ofw-id');

        // Set the applicant ID in the hidden field
        ofwidField.value = ofwId;
        // Open the modal
        modal.style.display = 'flex';
      });

      // Close modal when 'x' is clicked
      closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });

      // Close modal when clicked outside of the modal content
      window.addEventListener('click', function(event) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
  </script>
  <script src="../../javascript/script.js"></script> 
</body>
</html>
