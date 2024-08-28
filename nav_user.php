 <!-- Navigation -->
 <?php
include 'php/conn_db.php'; // Include your database connection script

// Start the session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkSession() {
    // Check if the session variable 'id' is set
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if session not found
        header("Location: ../html/login_employer.html");
        exit();
    } else {
        // If session exists, store the session data in a variable
        return $_SESSION['id'];
    }
}

$userId = checkSession(); // Get the user ID from the session

// Fetch user type and first name from the database if not already set in session
if (!isset($_SESSION['usertype']) || !isset($_SESSION['Fname'])) {
    $sql = "SELECT usertype, Fname FROM register WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['usertype'] = $row['usertype']; // Set the usertype session variable
        $_SESSION['Fname'] = $row['Fname']; // Set the user's first name session variable
    }
    $stmt->close();
}

$userType = $_SESSION['usertype']; // Get the usertype from the session
$firstName = $_SESSION['Fname'];   // Get the user's first name from the session

// Now, you have both the user ID, user type, and first name stored in session
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="stylesheet" href="css/style.css">
    <style>
        a.disabled {
        color: #d3d3d3;
        pointer-events: none;
        cursor: default;
        }
    </style>
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
            <li><a href="html/about.html">About Us</a></li>
            <li><a href="html/applicant.php">Applicant</a></li>
            <li><a href="html/services.html">Services</a></li>
            <li><a href="html/contact.html">Contact</a></li>
        </ul>
        <div class="auth">
        <button id ="emprof">  <?php echo htmlspecialchars($firstName); ?> </button>
        </div>
    </nav>

    <script>
    document.getElementById("emprof").addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior

      // Change the URL after the transition ends
      setTimeout(function () {
        window.location.href = "html/approf.php";
      }, 300); // Adjust the delay according to your transition duration

      // Adding the class to initiate the fade-in and slide-up animation
      document.body.classList.add('fade-in');
    });
  </script> 
</body>
</html>