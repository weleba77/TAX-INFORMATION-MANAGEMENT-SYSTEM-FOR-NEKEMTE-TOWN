<?php
session_start();
if (!isset($_SESSION['user_id']) ) {
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = 'admin';
// Include the connection file
include '../connection/connection.php';

// Check if the news ID is provided and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to delete the news item
    $query = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the admin dashboard or news page
        header("Location: news.php");
        exit();
    } else {
        echo "Error deleting news item.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid news ID.";
}
?>
