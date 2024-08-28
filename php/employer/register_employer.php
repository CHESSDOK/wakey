<?php
include 'conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert into empyers table
        $sql = "INSERT INTO empyers (username, password, email) VALUES ('$username', '$password', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            // Get the last inserted ID
            $employer_id = $conn->insert_id;

            // Insert into employer_profile table
            $sql = "INSERT INTO employer_profile (user_id, company_name, company_address) VALUES ('$employer_id', '', '')";
            
            if ($conn->query($sql) === TRUE) {
                // Commit the transaction
                $conn->commit();
                echo "New record and profile created successfully";
            } else {
                // Rollback the transaction if there's an error with the profile insert
                $conn->rollback();
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Rollback the transaction if there's an error with the registration insert
            $conn->rollback();
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of any exception
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
}
?>
