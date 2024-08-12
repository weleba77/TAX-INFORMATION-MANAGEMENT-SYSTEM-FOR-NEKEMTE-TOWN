<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if action and interviewer ID are set
if (isset($_GET['action']) && $_GET['action'] == 'disable' && isset($_GET['id'])) {
    include '../connection/connection.php';

    // Sanitize the ID to prevent SQL injection
    $interviewer_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare SQL statement to update interviewer status (example)
    $sql = "UPDATE interviewers status = 'disabled' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $interviewer_id);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success_msg'] = "Interviewer disabled successfully.";
    } else {
        $_SESSION['error_msg'] = "Error disabling interviewer: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['error_msg'] = "Invalid action or interviewer ID.";
}

header("Location: display_interviews.php");
exit();
?>
