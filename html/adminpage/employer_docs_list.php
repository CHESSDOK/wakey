<?php
include 'conn_db.php';

// Get user_id from URL
$user_id = intval($_GET['employer_id']);

// Fetch documents for the selected employer
$sql = "SELECT * FROM employer_documents WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
echo "
    <h1> employer list </h1>
    <table border='1'>
        <tr>
            <th>Document Name</th>
            <th>Document Path</th>
            <th>Verified</th>
        </tr>

     ";
     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["document_name"]) . "</td>
                    <td><a href='" . htmlspecialchars($row["document_path"]) . "' target='_blank'>View Document</a></td>
                    <td><a href='verify_documents.php?id=" . $row['id'] . " & user_id=". $user_id." '>Verify</a></td>
                    <td>" . ($row["is_verified"] ? 'Yes' : 'No') . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No documents found</td></tr>";
    }
    $conn->close();
?>
