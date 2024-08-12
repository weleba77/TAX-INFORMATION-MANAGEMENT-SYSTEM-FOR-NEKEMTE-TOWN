<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection/connection.php';

$income_id = $_POST['income_id'];
$action = $_POST['action'];
$interviewer_id = $_SESSION['user_id'];

if ($action === 'approve') {
    // Approve the receipt
    $query = "INSERT INTO receipt_approval (income_id, interviewer_id, interviewer_approved, admin_approved) 
              VALUES (?, ?, 1, 0) 
              ON DUPLICATE KEY UPDATE interviewer_approved = 1";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $income_id, $interviewer_id);
    $stmt->execute();


} else if ($action === 'disapprove') {
    // Fetch the current receipt image path
    $fetch_query = "SELECT receipt_image FROM income WHERE id = ?";
    $fetch_stmt = $conn->prepare($fetch_query);
    $fetch_stmt->bind_param('i', $income_id);
    $fetch_stmt->execute();
    $result = $fetch_stmt->get_result();
    $row = $result->fetch_assoc();
    $receipt_image = $row['receipt_image'];

    // Delete the receipt image file
    if (file_exists("../taxpayer/$receipt_image")) {
        unlink("../taxpayer/$receipt_image");
    }


    // Disapprove the receipt
    $query = "INSERT INTO receipt_approval (income_id, interviewer_id, interviewer_approved, admin_approved) 
              VALUES (?, ?, 0, 0) 
              ON DUPLICATE KEY UPDATE interviewer_approved = 0";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $income_id, $interviewer_id);
    $stmt->execute();

    // Notify the taxpayer to upload a new receipt
    $_SESSION['message'] = "Your receipt was disapproved. Please upload a new receipt.";
}

header("Location: manage_receipts.php");
exit();
?>
