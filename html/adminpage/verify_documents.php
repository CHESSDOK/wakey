<?php
include '../../php/conn_db.php';
$user_id = $_GET['user_id'];
$document_id = $_GET['id'];

$sql = "UPDATE employer_documents SET is_verified = TRUE WHERE id = '$document_id'";

if ($conn->query($sql) === TRUE) {
    echo "Document verified successfully!";
    header("Location: employer_docs_list.php?user_id=" . $user_id);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
