<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php';

$income_id = $_POST['income_id'];
$action = $_POST['action'];
$admin_id = $_SESSION['user_id'];

// Check if admin_id exists in the admin table
$check_admin_query = "SELECT id FROM admin WHERE id = ?";
$check_stmt = $conn->prepare($check_admin_query);
$check_stmt->bind_param('i', $admin_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows === 0) {
    // Admin ID does not exist
    echo "Invalid admin ID.";
    exit();
}

$check_stmt->close();

// Check if the receipt has been approved by the interviewer
$check_receipt_query = "SELECT interviewer_approved FROM receipt_approval WHERE income_id = ?";
$check_stmt = $conn->prepare($check_receipt_query);
$check_stmt->bind_param('i', $income_id);
$check_stmt->execute();
$check_stmt->bind_result($interviewer_approved);
$check_stmt->fetch();

if ($interviewer_approved !== 1) {
    // Receipt has not been approved by the interviewer
    echo "Receipt must be approved by the interviewer first.";
    exit();
}

$check_stmt->close();

// Prepare the appropriate query based on the action
if ($action === 'approve') {
    $query = "UPDATE receipt_approval SET admin_approved = 1 WHERE income_id = ?";
} else {
    $query = "UPDATE receipt_approval SET admin_approved = 0 WHERE income_id = ?";
}

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $income_id);

if ($stmt->execute()) {
    header("Location: manage_receipts.php");
    exit();
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
